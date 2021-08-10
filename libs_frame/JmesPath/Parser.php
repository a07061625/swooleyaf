<?php

namespace JmesPath;

use JmesPath\Lexer as T;

/**
 * JMESPath Pratt parser
 *
 * @see http://hall.org.ua/halls/wizzard/pdf/Vaughan.Pratt.TDOP.pdf
 */
class Parser
{
    /** @var Lexer */
    private $lexer;
    private $tokens;
    private $token;
    private $tpos;
    private $expression;
    private static $nullToken = ['type' => T::T_EOF];
    private static $currentNode = ['type' => T::T_CURRENT];

    private static $bp = [
        T::T_EOF => 0,
        T::T_QUOTED_IDENTIFIER => 0,
        T::T_IDENTIFIER => 0,
        T::T_RBRACKET => 0,
        T::T_RPAREN => 0,
        T::T_COMMA => 0,
        T::T_RBRACE => 0,
        T::T_NUMBER => 0,
        T::T_CURRENT => 0,
        T::T_EXPREF => 0,
        T::T_COLON => 0,
        T::T_PIPE => 1,
        T::T_OR => 2,
        T::T_AND => 3,
        T::T_COMPARATOR => 5,
        T::T_FLATTEN => 9,
        T::T_STAR => 20,
        T::T_FILTER => 21,
        T::T_DOT => 40,
        T::T_NOT => 45,
        T::T_LBRACE => 50,
        T::T_LBRACKET => 55,
        T::T_LPAREN => 60,
    ];

    /** @var array Acceptable tokens after a dot token */
    private static $afterDot = [
        T::T_IDENTIFIER => true, // foo.bar
        T::T_QUOTED_IDENTIFIER => true, // foo."bar"
        T::T_STAR => true, // foo.*
        T::T_LBRACE => true, // foo[1]
        T::T_LBRACKET => true, // foo{a: 0}
        T::T_FILTER => true, // foo.[?bar==10]
    ];

    /**
     * @param null|Lexer $lexer Lexer used to tokenize expressions
     */
    public function __construct(?Lexer $lexer = null)
    {
        $this->lexer = $lexer ?: new Lexer();
    }

    /**
     * @internal Handles undefined tokens without paying the cost of validation
     *
     * @param mixed $method
     * @param mixed $args
     */
    public function __call($method, $args)
    {
        $prefix = substr($method, 0, 4);
        if ('nud_' == $prefix || 'led_' == $prefix) {
            $token = substr($method, 4);
            $message = "Unexpected \"{$token}\" token ({$method}). Expected one of"
                . ' the following tokens: '
                . implode(', ', array_map(function ($i) {
                    return '"' . substr($i, 4) . '"';
                }, array_filter(
                    get_class_methods($this),
                    function ($i) use ($prefix) {
                        return 0 === strpos($i, $prefix);
                    }
                )));

            throw $this->syntax($message);
        }

        throw new \BadMethodCallException("Call to undefined method {$method}");
    }

    /**
     * Parses a JMESPath expression into an AST
     *
     * @param string $expression JMESPath expression to compile
     *
     * @return array Returns an array based AST
     *
     * @throws SyntaxErrorException
     */
    public function parse($expression)
    {
        $this->expression = $expression;
        $this->tokens = $this->lexer->tokenize($expression);
        $this->tpos = -1;
        $this->next();
        $result = $this->expr();

        if (T::T_EOF === $this->token['type']) {
            return $result;
        }

        throw $this->syntax('Did not reach the end of the token stream');
    }

    /**
     * Parses an expression while rbp < lbp.
     *
     * @param int $rbp Right bound precedence
     *
     * @return array
     */
    private function expr($rbp = 0)
    {
        $left = $this->{"nud_{$this->token['type']}"}();
        while ($rbp < self::$bp[$this->token['type']]) {
            $left = $this->{"led_{$this->token['type']}"}($left);
        }

        return $left;
    }

    private function nud_identifier()
    {
        $token = $this->token;
        $this->next();

        return ['type' => 'field', 'value' => $token['value']];
    }

    private function nud_quoted_identifier()
    {
        $token = $this->token;
        $this->next();
        $this->assertNotToken(T::T_LPAREN);

        return ['type' => 'field', 'value' => $token['value']];
    }

    private function nud_current()
    {
        $this->next();

        return self::$currentNode;
    }

    private function nud_literal()
    {
        $token = $this->token;
        $this->next();

        return ['type' => 'literal', 'value' => $token['value']];
    }

    private function nud_expref()
    {
        $this->next();

        return ['type' => T::T_EXPREF, 'children' => [$this->expr(self::$bp[T::T_EXPREF])]];
    }

    private function nud_not()
    {
        $this->next();

        return ['type' => T::T_NOT, 'children' => [$this->expr(self::$bp[T::T_NOT])]];
    }

    private function nud_lparen()
    {
        $this->next();
        $result = $this->expr(0);
        if (T::T_RPAREN !== $this->token['type']) {
            throw $this->syntax('Unclosed `(`');
        }
        $this->next();

        return $result;
    }

    private function nud_lbrace()
    {
        static $validKeys = [T::T_QUOTED_IDENTIFIER => true, T::T_IDENTIFIER => true];
        $this->next($validKeys);
        $pairs = [];

        do {
            $pairs[] = $this->parseKeyValuePair();
            if (T::T_COMMA == $this->token['type']) {
                $this->next($validKeys);
            }
        } while (T::T_RBRACE !== $this->token['type']);

        $this->next();

        return['type' => 'multi_select_hash', 'children' => $pairs];
    }

    private function nud_flatten()
    {
        return $this->led_flatten(self::$currentNode);
    }

    private function nud_filter()
    {
        return $this->led_filter(self::$currentNode);
    }

    private function nud_star()
    {
        return $this->parseWildcardObject(self::$currentNode);
    }

    private function nud_lbracket()
    {
        $this->next();
        $type = $this->token['type'];
        if (T::T_NUMBER == $type || T::T_COLON == $type) {
            return $this->parseArrayIndexExpression();
        }
        if (T::T_STAR == $type && T::T_RBRACKET == $this->lookahead()) {
            return $this->parseWildcardArray();
        }

        return $this->parseMultiSelectList();
    }

    private function led_lbracket(array $left)
    {
        static $nextTypes = [T::T_NUMBER => true, T::T_COLON => true, T::T_STAR => true];
        $this->next($nextTypes);
        switch ($this->token['type']) {
            case T::T_NUMBER:
            case T::T_COLON:
                return [
                    'type' => 'subexpression',
                    'children' => [$left, $this->parseArrayIndexExpression()],
                ];
            default:
                return $this->parseWildcardArray($left);
        }
    }

    private function led_flatten(array $left)
    {
        $this->next();

        return [
            'type' => 'projection',
            'from' => 'array',
            'children' => [
                ['type' => T::T_FLATTEN, 'children' => [$left]],
                $this->parseProjection(self::$bp[T::T_FLATTEN]),
            ],
        ];
    }

    private function led_dot(array $left)
    {
        $this->next(self::$afterDot);

        if (T::T_STAR == $this->token['type']) {
            return $this->parseWildcardObject($left);
        }

        return [
            'type' => 'subexpression',
            'children' => [$left, $this->parseDot(self::$bp[T::T_DOT])],
        ];
    }

    private function led_or(array $left)
    {
        $this->next();

        return [
            'type' => T::T_OR,
            'children' => [$left, $this->expr(self::$bp[T::T_OR])],
        ];
    }

    private function led_and(array $left)
    {
        $this->next();

        return [
            'type' => T::T_AND,
            'children' => [$left, $this->expr(self::$bp[T::T_AND])],
        ];
    }

    private function led_pipe(array $left)
    {
        $this->next();

        return [
            'type' => T::T_PIPE,
            'children' => [$left, $this->expr(self::$bp[T::T_PIPE])],
        ];
    }

    private function led_lparen(array $left)
    {
        $args = [];
        $this->next();

        while (T::T_RPAREN != $this->token['type']) {
            $args[] = $this->expr(0);
            if (T::T_COMMA == $this->token['type']) {
                $this->next();
            }
        }

        $this->next();

        return [
            'type' => 'function',
            'value' => $left['value'],
            'children' => $args,
        ];
    }

    private function led_filter(array $left)
    {
        $this->next();
        $expression = $this->expr();
        if (T::T_RBRACKET != $this->token['type']) {
            throw $this->syntax('Expected a closing rbracket for the filter');
        }

        $this->next();
        $rhs = $this->parseProjection(self::$bp[T::T_FILTER]);

        return [
            'type' => 'projection',
            'from' => 'array',
            'children' => [
                $left ?: self::$currentNode,
                [
                    'type' => 'condition',
                    'children' => [$expression, $rhs],
                ],
            ],
        ];
    }

    private function led_comparator(array $left)
    {
        $token = $this->token;
        $this->next();

        return [
            'type' => T::T_COMPARATOR,
            'value' => $token['value'],
            'children' => [$left, $this->expr(self::$bp[T::T_COMPARATOR])],
        ];
    }

    private function parseProjection($bp)
    {
        $type = $this->token['type'];
        if (self::$bp[$type] < 10) {
            return self::$currentNode;
        }
        if (T::T_DOT == $type) {
            $this->next(self::$afterDot);

            return $this->parseDot($bp);
        }
        if (T::T_LBRACKET == $type || T::T_FILTER == $type) {
            return $this->expr($bp);
        }

        throw $this->syntax('Syntax error after projection');
    }

    private function parseDot($bp)
    {
        if (T::T_LBRACKET == $this->token['type']) {
            $this->next();

            return $this->parseMultiSelectList();
        }

        return $this->expr($bp);
    }

    private function parseKeyValuePair()
    {
        static $validColon = [T::T_COLON => true];
        $key = $this->token['value'];
        $this->next($validColon);
        $this->next();

        return [
            'type' => 'key_val_pair',
            'value' => $key,
            'children' => [$this->expr()],
        ];
    }

    private function parseWildcardObject(?array $left = null)
    {
        $this->next();

        return [
            'type' => 'projection',
            'from' => 'object',
            'children' => [
                $left ?: self::$currentNode,
                $this->parseProjection(self::$bp[T::T_STAR]),
            ],
        ];
    }

    private function parseWildcardArray(?array $left = null)
    {
        static $getRbracket = [T::T_RBRACKET => true];
        $this->next($getRbracket);
        $this->next();

        return [
            'type' => 'projection',
            'from' => 'array',
            'children' => [
                $left ?: self::$currentNode,
                $this->parseProjection(self::$bp[T::T_STAR]),
            ],
        ];
    }

    /**
     * Parses an array index expression (e.g., [0], [1:2:3]
     */
    private function parseArrayIndexExpression()
    {
        static $matchNext = [
            T::T_NUMBER => true,
            T::T_COLON => true,
            T::T_RBRACKET => true,
        ];

        $pos = 0;
        $parts = [null, null, null];
        $expected = $matchNext;

        do {
            if (T::T_COLON == $this->token['type']) {
                ++$pos;
                $expected = $matchNext;
            } elseif (T::T_NUMBER == $this->token['type']) {
                $parts[$pos] = $this->token['value'];
                $expected = [T::T_COLON => true, T::T_RBRACKET => true];
            }
            $this->next($expected);
        } while (T::T_RBRACKET != $this->token['type']);

        // Consume the closing bracket
        $this->next();

        if (0 === $pos) {
            // No colons were found so this is a simple index extraction
            return ['type' => 'index', 'value' => $parts[0]];
        }

        if ($pos > 2) {
            throw $this->syntax('Invalid array slice syntax: too many colons');
        }

        // Sliced array from start (e.g., [2:])
        return [
            'type' => 'projection',
            'from' => 'array',
            'children' => [
                ['type' => 'slice', 'value' => $parts],
                $this->parseProjection(self::$bp[T::T_STAR]),
            ],
        ];
    }

    private function parseMultiSelectList()
    {
        $nodes = [];

        do {
            $nodes[] = $this->expr();
            if (T::T_COMMA == $this->token['type']) {
                $this->next();
                $this->assertNotToken(T::T_RBRACKET);
            }
        } while (T::T_RBRACKET !== $this->token['type']);
        $this->next();

        return ['type' => 'multi_select_list', 'children' => $nodes];
    }

    private function syntax($msg)
    {
        return new SyntaxErrorException($msg, $this->token, $this->expression);
    }

    private function lookahead()
    {
        return (!isset($this->tokens[$this->tpos + 1]))
            ? T::T_EOF
            : $this->tokens[$this->tpos + 1]['type'];
    }

    private function next(?array $match = null)
    {
        if (!isset($this->tokens[$this->tpos + 1])) {
            $this->token = self::$nullToken;
        } else {
            $this->token = $this->tokens[++$this->tpos];
        }

        if ($match && !isset($match[$this->token['type']])) {
            throw $this->syntax($match);
        }
    }

    private function assertNotToken($type)
    {
        if ($this->token['type'] == $type) {
            throw $this->syntax("Token {$this->tpos} not allowed to be {$type}");
        }
    }
}
