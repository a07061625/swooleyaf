<?php
/**
 * Checks that control structures are defined and indented correctly.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class ScopeIndentSniff implements Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = [
        'PHP',
        'JS',
    ];

    /**
     * The number of spaces code should be indented.
     *
     * @var int
     */
    public $indent = 4;

    /**
     * Does the indent need to be exactly right?
     *
     * If TRUE, indent needs to be exactly $indent spaces. If FALSE,
     * indent needs to be at least $indent spaces (but can be more).
     *
     * @var bool
     */
    public $exact = false;

    /**
     * Should tabs be used for indenting?
     *
     * If TRUE, fixes will be made using tabs instead of spaces.
     * The size of each tab is important, so it should be specified
     * using the --tab-width CLI argument.
     *
     * @var bool
     */
    public $tabIndent = false;

    /**
     * List of tokens not needing to be checked for indentation.
     *
     * Useful to allow Sniffs based on this to easily ignore/skip some
     * tokens from verification. For example, inline HTML sections
     * or PHP open/close tags can escape from here and have their own
     * rules elsewhere.
     *
     * @var int[]
     */
    public $ignoreIndentationTokens = [];

    /**
     * Any scope openers that should not cause an indent.
     *
     * @var int[]
     */
    protected $nonIndentingScopes = [];

    /**
     * The --tab-width CLI value that is being used.
     *
     * @var int
     */
    private $tabWidth;

    /**
     * List of tokens not needing to be checked for indentation.
     *
     * This is a cached copy of the public version of this var, which
     * can be set in a ruleset file, and some core ignored tokens.
     *
     * @var int[]
     */
    private $ignoreIndentation = [];

    /**
     * Show debug output for this sniff.
     *
     * @var bool
     */
    private $debug = false;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        if (true === \defined('PHP_CODESNIFFER_IN_TESTS')) {
            $this->debug = false;
        }

        return [T_OPEN_TAG];
    }

    //end register()

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile All the tokens found in the document.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     *
     * @return int
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $debug = Config::getConfigData('scope_indent_debug');
        if (null !== $debug) {
            $this->debug = (bool)$debug;
        }

        if (null === $this->tabWidth) {
            if (false === isset($phpcsFile->config->tabWidth) || 0 === $phpcsFile->config->tabWidth) {
                // We have no idea how wide tabs are, so assume 4 spaces for fixing.
                // It shouldn't really matter because indent checks elsewhere in the
                // standard should fix things up.
                $this->tabWidth = 4;
            } else {
                $this->tabWidth = $phpcsFile->config->tabWidth;
            }
        }

        $lastOpenTag = $stackPtr;
        $lastCloseTag = null;
        $openScopes = [];
        $adjustments = [];
        $setIndents = [];
        $disableExactEnd = 0;

        $tokens = $phpcsFile->getTokens();
        $first = $phpcsFile->findFirstOnLine(T_INLINE_HTML, $stackPtr);
        $trimmed = ltrim($tokens[$first]['content']);
        if ('' === $trimmed) {
            $currentIndent = ($tokens[$stackPtr]['column'] - 1);
        } else {
            $currentIndent = (\strlen($tokens[$first]['content']) - \strlen($trimmed));
        }

        if (true === $this->debug) {
            $line = $tokens[$stackPtr]['line'];
            echo "Start with token {$stackPtr} on line {$line} with indent {$currentIndent}" . PHP_EOL;
        }

        if (true === empty($this->ignoreIndentation)) {
            $this->ignoreIndentation = [T_INLINE_HTML => true];
            foreach ($this->ignoreIndentationTokens as $token) {
                if (false === \is_int($token)) {
                    if (false === \defined($token)) {
                        continue;
                    }

                    $token = \constant($token);
                }

                $this->ignoreIndentation[$token] = true;
            }
        }//end if

        $this->exact = (bool)$this->exact;
        $this->tabIndent = (bool)$this->tabIndent;

        $checkAnnotations = $phpcsFile->config->annotations;

        for ($i = ($stackPtr + 1); $i < $phpcsFile->numTokens; ++$i) {
            if (false === $i) {
                // Something has gone very wrong; maybe a parse error.
                break;
            }

            if (true === $checkAnnotations
                && T_PHPCS_SET === $tokens[$i]['code']
                && true === isset($tokens[$i]['sniffCode'])
                && 'Generic.WhiteSpace.ScopeIndent' === $tokens[$i]['sniffCode']
                && 'exact' === $tokens[$i]['sniffProperty']
            ) {
                $value = $tokens[$i]['sniffPropertyValue'];
                if ('true' === $value) {
                    $value = true;
                } elseif ('false' === $value) {
                    $value = false;
                } else {
                    $value = (bool)$value;
                }

                $this->exact = $value;

                if (true === $this->debug) {
                    $line = $tokens[$i]['line'];
                    if (true === $this->exact) {
                        $value = 'true';
                    } else {
                        $value = 'false';
                    }

                    echo "* token {$i} on line {$line} set exact flag to {$value} *" . PHP_EOL;
                }
            }//end if

            $checkToken = null;
            $checkIndent = null;

            /*
                Don't check indents exactly between parenthesis or arrays as they
                tend to have custom rules, such as with multi-line function calls
                and control structure conditions.
            */

            $exact = $this->exact;

            if (T_OPEN_PARENTHESIS === $tokens[$i]['code']
                && true === isset($tokens[$i]['parenthesis_closer'])
            ) {
                $disableExactEnd = max($disableExactEnd, $tokens[$i]['parenthesis_closer']);
                if (true === $this->debug) {
                    $line = $tokens[$i]['line'];
                    $type = $tokens[$disableExactEnd]['type'];
                    echo "Opening parenthesis found on line {$line}" . PHP_EOL;
                    echo "\t=> disabling exact indent checking until {$disableExactEnd} ({$type})" . PHP_EOL;
                }
            }

            if (true === $exact && $i < $disableExactEnd) {
                $exact = false;
            }

            // Detect line changes and figure out where the indent is.
            if (1 === $tokens[$i]['column']) {
                $trimmed = ltrim($tokens[$i]['content']);
                if ('' === $trimmed) {
                    if (true === isset($tokens[($i + 1)])
                        && $tokens[$i]['line'] === $tokens[($i + 1)]['line']
                    ) {
                        $checkToken = ($i + 1);
                        $tokenIndent = ($tokens[($i + 1)]['column'] - 1);
                    }
                } else {
                    $checkToken = $i;
                    $tokenIndent = (\strlen($tokens[$i]['content']) - \strlen($trimmed));
                }
            }

            // Closing parenthesis should just be indented to at least
            // the same level as where they were opened (but can be more).
            if ((null !== $checkToken
                && T_CLOSE_PARENTHESIS === $tokens[$checkToken]['code']
                && true === isset($tokens[$checkToken]['parenthesis_opener']))
                || (T_CLOSE_PARENTHESIS === $tokens[$i]['code']
                && true === isset($tokens[$i]['parenthesis_opener']))
            ) {
                if (null !== $checkToken) {
                    $parenCloser = $checkToken;
                } else {
                    $parenCloser = $i;
                }

                if (true === $this->debug) {
                    $line = $tokens[$i]['line'];
                    echo "Closing parenthesis found on line {$line}" . PHP_EOL;
                }

                $parenOpener = $tokens[$parenCloser]['parenthesis_opener'];
                if ($tokens[$parenCloser]['line'] !== $tokens[$parenOpener]['line']) {
                    $parens = 0;
                    if (true === isset($tokens[$parenCloser]['nested_parenthesis'])
                        && false === empty($tokens[$parenCloser]['nested_parenthesis'])
                    ) {
                        $parens = $tokens[$parenCloser]['nested_parenthesis'];
                        end($parens);
                        $parens = key($parens);
                        if (true === $this->debug) {
                            $line = $tokens[$parens]['line'];
                            echo "\t* token has nested parenthesis {$parens} on line {$line} *" . PHP_EOL;
                        }
                    }

                    $condition = 0;
                    if (true === isset($tokens[$parenCloser]['conditions'])
                        && false === empty($tokens[$parenCloser]['conditions'])
                        && (false === isset($tokens[$parenCloser]['parenthesis_owner'])
                        || $parens > 0)
                    ) {
                        $condition = $tokens[$parenCloser]['conditions'];
                        end($condition);
                        $condition = key($condition);
                        if (true === $this->debug) {
                            $line = $tokens[$condition]['line'];
                            $type = $tokens[$condition]['type'];
                            echo "\t* token is inside condition {$condition} ({$type}) on line {$line} *" . PHP_EOL;
                        }
                    }

                    if ($parens > $condition) {
                        if (true === $this->debug) {
                            echo "\t* using parenthesis *" . PHP_EOL;
                        }

                        $parenOpener = $parens;
                        $condition = 0;
                    } elseif ($condition > 0) {
                        if (true === $this->debug) {
                            echo "\t* using condition *" . PHP_EOL;
                        }

                        $parenOpener = $condition;
                        $parens = 0;
                    }

                    $exact = false;

                    $lastOpenTagConditions = array_keys($tokens[$lastOpenTag]['conditions']);
                    $lastOpenTagCondition = array_pop($lastOpenTagConditions);

                    if ($condition > 0 && $lastOpenTagCondition === $condition) {
                        if (true === $this->debug) {
                            echo "\t* open tag is inside condition; using open tag *" . PHP_EOL;
                        }

                        $checkIndent = ($tokens[$lastOpenTag]['column'] - 1);
                        if (true === isset($adjustments[$condition])) {
                            $checkIndent += $adjustments[$condition];
                        }

                        $currentIndent = $checkIndent;

                        if (true === $this->debug) {
                            $type = $tokens[$lastOpenTag]['type'];
                            echo "\t=> checking indent of {$checkIndent}; main indent set to {$currentIndent} by token {$lastOpenTag} ({$type})" . PHP_EOL;
                        }
                    } elseif ($condition > 0
                        && true === isset($tokens[$condition]['scope_opener'])
                        && true === isset($setIndents[$tokens[$condition]['scope_opener']])
                    ) {
                        $checkIndent = $setIndents[$tokens[$condition]['scope_opener']];
                        if (true === isset($adjustments[$condition])) {
                            $checkIndent += $adjustments[$condition];
                        }

                        $currentIndent = $checkIndent;

                        if (true === $this->debug) {
                            $type = $tokens[$condition]['type'];
                            echo "\t=> checking indent of {$checkIndent}; main indent set to {$currentIndent} by token {$condition} ({$type})" . PHP_EOL;
                        }
                    } else {
                        $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $parenOpener, true);

                        $checkIndent = ($tokens[$first]['column'] - 1);
                        if (true === isset($adjustments[$first])) {
                            $checkIndent += $adjustments[$first];
                        }

                        if (true === $this->debug) {
                            $line = $tokens[$first]['line'];
                            $type = $tokens[$first]['type'];
                            echo "\t* first token on line {$line} is {$first} ({$type}) *" . PHP_EOL;
                        }

                        if ($first === $tokens[$parenCloser]['parenthesis_opener']
                            && $tokens[($first - 1)]['line'] === $tokens[$first]['line']
                        ) {
                            // This is unlikely to be the start of the statement, so look
                            // back further to find it.
                            --$first;
                            if (true === $this->debug) {
                                $line = $tokens[$first]['line'];
                                $type = $tokens[$first]['type'];
                                echo "\t* first token is the parenthesis opener *" . PHP_EOL;
                                echo "\t* amended first token is {$first} ({$type}) on line {$line} *" . PHP_EOL;
                            }
                        }

                        $prev = $phpcsFile->findStartOfStatement($first, T_COMMA);
                        if ($prev !== $first) {
                            // This is not the start of the statement.
                            if (true === $this->debug) {
                                $line = $tokens[$prev]['line'];
                                $type = $tokens[$prev]['type'];
                                echo "\t* previous is {$type} on line {$line} *" . PHP_EOL;
                            }

                            $first = $phpcsFile->findFirstOnLine([T_WHITESPACE, T_INLINE_HTML], $prev, true);
                            if (false !== $first) {
                                $prev = $phpcsFile->findStartOfStatement($first, T_COMMA);
                                $first = $phpcsFile->findFirstOnLine([T_WHITESPACE, T_INLINE_HTML], $prev, true);
                            } else {
                                $first = $prev;
                            }

                            if (true === $this->debug) {
                                $line = $tokens[$first]['line'];
                                $type = $tokens[$first]['type'];
                                echo "\t* amended first token is {$first} ({$type}) on line {$line} *" . PHP_EOL;
                            }
                        }//end if

                        if (true === isset($tokens[$first]['scope_closer'])
                            && $tokens[$first]['scope_closer'] === $first
                        ) {
                            if (true === $this->debug) {
                                echo "\t* first token is a scope closer *" . PHP_EOL;
                            }

                            if (true === isset($tokens[$first]['scope_condition'])) {
                                $scopeCloser = $first;
                                $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $tokens[$scopeCloser]['scope_condition'], true);

                                $currentIndent = ($tokens[$first]['column'] - 1);
                                if (true === isset($adjustments[$first])) {
                                    $currentIndent += $adjustments[$first];
                                }

                                // Make sure it is divisible by our expected indent.
                                if (T_CLOSURE !== $tokens[$tokens[$scopeCloser]['scope_condition']]['code']) {
                                    $currentIndent = (int)(ceil($currentIndent / $this->indent) * $this->indent);
                                }

                                $setIndents[$first] = $currentIndent;

                                if (true === $this->debug) {
                                    $type = $tokens[$first]['type'];
                                    echo "\t=> indent set to {$currentIndent} by token {$first} ({$type})" . PHP_EOL;
                                }
                            }//end if
                        } else {
                            // Don't force current indent to be divisible because there could be custom
                            // rules in place between parenthesis, such as with arrays.
                            $currentIndent = ($tokens[$first]['column'] - 1);
                            if (true === isset($adjustments[$first])) {
                                $currentIndent += $adjustments[$first];
                            }

                            $setIndents[$first] = $currentIndent;

                            if (true === $this->debug) {
                                $type = $tokens[$first]['type'];
                                echo "\t=> checking indent of {$checkIndent}; main indent set to {$currentIndent} by token {$first} ({$type})" . PHP_EOL;
                            }
                        }//end if
                    }//end if
                } elseif (true === $this->debug) {
                    echo "\t * ignoring single-line definition *" . PHP_EOL;
                }//end if
            }//end if

            // Closing short array bracket should just be indented to at least
            // the same level as where it was opened (but can be more).
            if (T_CLOSE_SHORT_ARRAY === $tokens[$i]['code']
                || (null !== $checkToken
                && T_CLOSE_SHORT_ARRAY === $tokens[$checkToken]['code'])
            ) {
                if (null !== $checkToken) {
                    $arrayCloser = $checkToken;
                } else {
                    $arrayCloser = $i;
                }

                if (true === $this->debug) {
                    $line = $tokens[$arrayCloser]['line'];
                    echo "Closing short array bracket found on line {$line}" . PHP_EOL;
                }

                $arrayOpener = $tokens[$arrayCloser]['bracket_opener'];
                if ($tokens[$arrayCloser]['line'] !== $tokens[$arrayOpener]['line']) {
                    $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $arrayOpener, true);
                    $exact = false;

                    if (true === $this->debug) {
                        $line = $tokens[$first]['line'];
                        $type = $tokens[$first]['type'];
                        echo "\t* first token on line {$line} is {$first} ({$type}) *" . PHP_EOL;
                    }

                    if ($first === $tokens[$arrayCloser]['bracket_opener']) {
                        // This is unlikely to be the start of the statement, so look
                        // back further to find it.
                        --$first;
                    }

                    $prev = $phpcsFile->findStartOfStatement($first, [T_COMMA, T_DOUBLE_ARROW]);
                    if ($prev !== $first) {
                        // This is not the start of the statement.
                        if (true === $this->debug) {
                            $line = $tokens[$prev]['line'];
                            $type = $tokens[$prev]['type'];
                            echo "\t* previous is {$type} on line {$line} *" . PHP_EOL;
                        }

                        $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $prev, true);
                        $prev = $phpcsFile->findStartOfStatement($first, [T_COMMA, T_DOUBLE_ARROW]);
                        $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $prev, true);
                        if (true === $this->debug) {
                            $line = $tokens[$first]['line'];
                            $type = $tokens[$first]['type'];
                            echo "\t* amended first token is {$first} ({$type}) on line {$line} *" . PHP_EOL;
                        }
                    } elseif (T_WHITESPACE === $tokens[$first]['code']) {
                        $first = $phpcsFile->findNext(T_WHITESPACE, ($first + 1), null, true);
                    }

                    $checkIndent = ($tokens[$first]['column'] - 1);
                    if (true === isset($adjustments[$first])) {
                        $checkIndent += $adjustments[$first];
                    }

                    if (true === isset($tokens[$first]['scope_closer'])
                        && $tokens[$first]['scope_closer'] === $first
                    ) {
                        // The first token is a scope closer and would have already
                        // been processed and set the indent level correctly, so
                        // don't adjust it again.
                        if (true === $this->debug) {
                            echo "\t* first token is a scope closer; ignoring closing short array bracket *" . PHP_EOL;
                        }

                        if (true === isset($setIndents[$first])) {
                            $currentIndent = $setIndents[$first];
                            if (true === $this->debug) {
                                echo "\t=> indent reset to {$currentIndent}" . PHP_EOL;
                            }
                        }
                    } else {
                        // Don't force current indent to be divisible because there could be custom
                        // rules in place for arrays.
                        $currentIndent = ($tokens[$first]['column'] - 1);
                        if (true === isset($adjustments[$first])) {
                            $currentIndent += $adjustments[$first];
                        }

                        $setIndents[$first] = $currentIndent;

                        if (true === $this->debug) {
                            $type = $tokens[$first]['type'];
                            echo "\t=> checking indent of {$checkIndent}; main indent set to {$currentIndent} by token {$first} ({$type})" . PHP_EOL;
                        }
                    }//end if
                } elseif (true === $this->debug) {
                    echo "\t * ignoring single-line definition *" . PHP_EOL;
                }//end if
            }//end if

            // Adjust lines within scopes while auto-fixing.
            if (null !== $checkToken
                && false === $exact
                && (false === empty($tokens[$checkToken]['conditions'])
                || (true === isset($tokens[$checkToken]['scope_opener'])
                && $tokens[$checkToken]['scope_opener'] === $checkToken))
            ) {
                if (false === empty($tokens[$checkToken]['conditions'])) {
                    $condition = $tokens[$checkToken]['conditions'];
                    end($condition);
                    $condition = key($condition);
                } else {
                    $condition = $tokens[$checkToken]['scope_condition'];
                }

                $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $condition, true);

                if (true === isset($adjustments[$first])
                    && (($adjustments[$first] < 0 && $tokenIndent > $currentIndent)
                    || ($adjustments[$first] > 0 && $tokenIndent < $currentIndent))
                ) {
                    $length = ($tokenIndent + $adjustments[$first]);

                    // When fixing, we're going to adjust the indent of this line
                    // here automatically, so use this new padding value when
                    // comparing the expected padding to the actual padding.
                    if (true === $phpcsFile->fixer->enabled) {
                        $tokenIndent = $length;
                        $this->adjustIndent($phpcsFile, $checkToken, $length, $adjustments[$first]);
                    }

                    if (true === $this->debug) {
                        $line = $tokens[$checkToken]['line'];
                        $type = $tokens[$checkToken]['type'];
                        echo "Indent adjusted to {$length} for {$type} on line {$line}" . PHP_EOL;
                    }

                    $adjustments[$checkToken] = $adjustments[$first];

                    if (true === $this->debug) {
                        $line = $tokens[$checkToken]['line'];
                        $type = $tokens[$checkToken]['type'];
                        echo "\t=> add adjustment of " . $adjustments[$checkToken] . " for token {$checkToken} ({$type}) on line {$line}" . PHP_EOL;
                    }
                }//end if
            }//end if

            // Scope closers reset the required indent to the same level as the opening condition.
            if ((null !== $checkToken
                && true === isset($openScopes[$checkToken])
                || (true === isset($tokens[$checkToken]['scope_condition'])
                && true === isset($tokens[$checkToken]['scope_closer'])
                && $tokens[$checkToken]['scope_closer'] === $checkToken
                && $tokens[$checkToken]['line'] !== $tokens[$tokens[$checkToken]['scope_opener']]['line']))
                || (null === $checkToken
                && true === isset($openScopes[$i]))
            ) {
                if (true === $this->debug) {
                    if (null === $checkToken) {
                        $type = $tokens[$tokens[$i]['scope_condition']]['type'];
                        $line = $tokens[$i]['line'];
                    } else {
                        $type = $tokens[$tokens[$checkToken]['scope_condition']]['type'];
                        $line = $tokens[$checkToken]['line'];
                    }

                    echo "Close scope ({$type}) on line {$line}" . PHP_EOL;
                }

                $scopeCloser = $checkToken;
                if (null === $scopeCloser) {
                    $scopeCloser = $i;
                }

                $conditionToken = array_pop($openScopes);
                if (true === $this->debug) {
                    $line = $tokens[$conditionToken]['line'];
                    $type = $tokens[$conditionToken]['type'];
                    echo "\t=> removed open scope {$conditionToken} ({$type}) on line {$line}" . PHP_EOL;
                }

                if (true === isset($tokens[$scopeCloser]['scope_condition'])) {
                    $first = $phpcsFile->findFirstOnLine([T_WHITESPACE, T_INLINE_HTML], $tokens[$scopeCloser]['scope_condition'], true);
                    if (true === $this->debug) {
                        $line = $tokens[$first]['line'];
                        $type = $tokens[$first]['type'];
                        echo "\t* first token is {$first} ({$type}) on line {$line} *" . PHP_EOL;
                    }

                    while (T_CONSTANT_ENCAPSED_STRING === $tokens[$first]['code']
                        && T_CONSTANT_ENCAPSED_STRING === $tokens[($first - 1)]['code']
                    ) {
                        $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, ($first - 1), true);
                        if (true === $this->debug) {
                            $line = $tokens[$first]['line'];
                            $type = $tokens[$first]['type'];
                            echo "\t* found multi-line string; amended first token is {$first} ({$type}) on line {$line} *" . PHP_EOL;
                        }
                    }

                    $currentIndent = ($tokens[$first]['column'] - 1);
                    if (true === isset($adjustments[$first])) {
                        $currentIndent += $adjustments[$first];
                    }

                    $setIndents[$scopeCloser] = $currentIndent;

                    if (true === $this->debug) {
                        $type = $tokens[$scopeCloser]['type'];
                        echo "\t=> indent set to {$currentIndent} by token {$scopeCloser} ({$type})" . PHP_EOL;
                    }

                    // We only check the indent of scope closers if they are
                    // curly braces because other constructs tend to have different rules.
                    if (T_CLOSE_CURLY_BRACKET === $tokens[$scopeCloser]['code']) {
                        $exact = true;
                    } else {
                        $checkToken = null;
                    }
                }//end if
            }//end if

            // Handle scope for JS object notation.
            if ('JS' === $phpcsFile->tokenizerType
                && ((null !== $checkToken
                && T_CLOSE_OBJECT === $tokens[$checkToken]['code']
                && $tokens[$checkToken]['line'] !== $tokens[$tokens[$checkToken]['bracket_opener']]['line'])
                || (null === $checkToken
                && T_CLOSE_OBJECT === $tokens[$i]['code']
                && $tokens[$i]['line'] !== $tokens[$tokens[$i]['bracket_opener']]['line']))
            ) {
                if (true === $this->debug) {
                    $line = $tokens[$i]['line'];
                    echo "Close JS object on line {$line}" . PHP_EOL;
                }

                $scopeCloser = $checkToken;
                if (null === $scopeCloser) {
                    $scopeCloser = $i;
                } else {
                    $conditionToken = array_pop($openScopes);
                    if (true === $this->debug) {
                        $line = $tokens[$conditionToken]['line'];
                        $type = $tokens[$conditionToken]['type'];
                        echo "\t=> removed open scope {$conditionToken} ({$type}) on line {$line}" . PHP_EOL;
                    }
                }

                $parens = 0;
                if (true === isset($tokens[$scopeCloser]['nested_parenthesis'])
                    && false === empty($tokens[$scopeCloser]['nested_parenthesis'])
                ) {
                    $parens = $tokens[$scopeCloser]['nested_parenthesis'];
                    end($parens);
                    $parens = key($parens);
                    if (true === $this->debug) {
                        $line = $tokens[$parens]['line'];
                        echo "\t* token has nested parenthesis {$parens} on line {$line} *" . PHP_EOL;
                    }
                }

                $condition = 0;
                if (true === isset($tokens[$scopeCloser]['conditions'])
                    && false === empty($tokens[$scopeCloser]['conditions'])
                ) {
                    $condition = $tokens[$scopeCloser]['conditions'];
                    end($condition);
                    $condition = key($condition);
                    if (true === $this->debug) {
                        $line = $tokens[$condition]['line'];
                        $type = $tokens[$condition]['type'];
                        echo "\t* token is inside condition {$condition} ({$type}) on line {$line} *" . PHP_EOL;
                    }
                }

                if ($parens > $condition) {
                    if (true === $this->debug) {
                        echo "\t* using parenthesis *" . PHP_EOL;
                    }

                    $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $parens, true);
                    $condition = 0;
                } elseif ($condition > 0) {
                    if (true === $this->debug) {
                        echo "\t* using condition *" . PHP_EOL;
                    }

                    $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $condition, true);
                    $parens = 0;
                } else {
                    if (true === $this->debug) {
                        $line = $tokens[$tokens[$scopeCloser]['bracket_opener']]['line'];
                        echo "\t* token is not in parenthesis or condition; using opener on line {$line} *" . PHP_EOL;
                    }

                    $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $tokens[$scopeCloser]['bracket_opener'], true);
                }//end if

                $currentIndent = ($tokens[$first]['column'] - 1);
                if (true === isset($adjustments[$first])) {
                    $currentIndent += $adjustments[$first];
                }

                if ($parens > 0 || $condition > 0) {
                    $checkIndent = ($tokens[$first]['column'] - 1);
                    if (true === isset($adjustments[$first])) {
                        $checkIndent += $adjustments[$first];
                    }

                    if ($condition > 0) {
                        $checkIndent += $this->indent;
                        $currentIndent += $this->indent;
                        $exact = true;
                    }
                } else {
                    $checkIndent = $currentIndent;
                }

                // Make sure it is divisible by our expected indent.
                $currentIndent = (int)(ceil($currentIndent / $this->indent) * $this->indent);
                $checkIndent = (int)(ceil($checkIndent / $this->indent) * $this->indent);
                $setIndents[$first] = $currentIndent;

                if (true === $this->debug) {
                    $type = $tokens[$first]['type'];
                    echo "\t=> checking indent of {$checkIndent}; main indent set to {$currentIndent} by token {$first} ({$type})" . PHP_EOL;
                }
            }//end if

            if (null !== $checkToken
                && true === isset(Tokens::$scopeOpeners[$tokens[$checkToken]['code']])
                && false === \in_array($tokens[$checkToken]['code'], $this->nonIndentingScopes, true)
                && true === isset($tokens[$checkToken]['scope_opener'])
            ) {
                $exact = true;

                $lastOpener = null;
                if (false === empty($openScopes)) {
                    end($openScopes);
                    $lastOpener = current($openScopes);
                }

                // A scope opener that shares a closer with another token (like multiple
                // CASEs using the same BREAK) needs to reduce the indent level so its
                // indent is checked correctly. It will then increase the indent again
                // (as all openers do) after being checked.
                if (null !== $lastOpener
                    && true === isset($tokens[$lastOpener]['scope_closer'])
                    && $tokens[$lastOpener]['level'] === $tokens[$checkToken]['level']
                    && $tokens[$lastOpener]['scope_closer'] === $tokens[$checkToken]['scope_closer']
                ) {
                    $currentIndent -= $this->indent;
                    $setIndents[$lastOpener] = $currentIndent;
                    if (true === $this->debug) {
                        $line = $tokens[$i]['line'];
                        $type = $tokens[$lastOpener]['type'];
                        echo "Shared closer found on line {$line}" . PHP_EOL;
                        echo "\t=> indent set to {$currentIndent} by token {$lastOpener} ({$type})" . PHP_EOL;
                    }
                }

                if (T_CLOSURE === $tokens[$checkToken]['code']
                    && $tokenIndent > $currentIndent
                ) {
                    // The opener is indented more than needed, which is fine.
                    // But just check that it is divisible by our expected indent.
                    $checkIndent = (int)(ceil($tokenIndent / $this->indent) * $this->indent);
                    $exact = false;

                    if (true === $this->debug) {
                        $line = $tokens[$i]['line'];
                        echo "Closure found on line {$line}" . PHP_EOL;
                        echo "\t=> checking indent of {$checkIndent}; main indent remains at {$currentIndent}" . PHP_EOL;
                    }
                }
            }//end if

            // Method prefix indentation has to be exact or else it will break
            // the rest of the function declaration, and potentially future ones.
            if (null !== $checkToken
                && true === isset(Tokens::$methodPrefixes[$tokens[$checkToken]['code']])
                && T_DOUBLE_COLON !== $tokens[($checkToken + 1)]['code']
            ) {
                $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($checkToken + 1), null, true);
                if (false === $next
                    || (T_CLOSURE !== $tokens[$next]['code']
                    && T_VARIABLE !== $tokens[$next]['code']
                    && T_FN !== $tokens[$next]['code'])
                ) {
                    if (true === $this->debug) {
                        $line = $tokens[$checkToken]['line'];
                        $type = $tokens[$checkToken]['type'];
                        echo "\t* method prefix ({$type}) found on line {$line}; indent set to exact *" . PHP_EOL;
                    }

                    $exact = true;
                }
            }

            // JS property indentation has to be exact or else if will break
            // things like function and object indentation.
            if (null !== $checkToken && T_PROPERTY === $tokens[$checkToken]['code']) {
                $exact = true;
            }

            // Open PHP tags needs to be indented to exact column positions
            // so they don't cause problems with indent checks for the code
            // within them, but they don't need to line up with the current indent
            // in most cases.
            if (null !== $checkToken
                && (T_OPEN_TAG === $tokens[$checkToken]['code']
                || T_OPEN_TAG_WITH_ECHO === $tokens[$checkToken]['code'])
            ) {
                $checkIndent = ($tokens[$checkToken]['column'] - 1);

                // If we are re-opening a block that was closed in the same
                // scope as us, then reset the indent back to what the scope opener
                // set instead of using whatever indent this open tag has set.
                if (false === empty($tokens[$checkToken]['conditions'])) {
                    $close = $phpcsFile->findPrevious(T_CLOSE_TAG, ($checkToken - 1));
                    if (false !== $close
                        && $tokens[$checkToken]['conditions'] === $tokens[$close]['conditions']
                    ) {
                        $conditions = array_keys($tokens[$checkToken]['conditions']);
                        $lastCondition = array_pop($conditions);
                        $lastOpener = $tokens[$lastCondition]['scope_opener'];
                        $lastCloser = $tokens[$lastCondition]['scope_closer'];
                        if ($tokens[$lastCloser]['line'] !== $tokens[$checkToken]['line']
                            && true === isset($setIndents[$lastOpener])
                        ) {
                            $checkIndent = $setIndents[$lastOpener];
                        }
                    }
                }
            }//end if

            // Close tags needs to be indented to exact column positions.
            if (null !== $checkToken && T_CLOSE_TAG === $tokens[$checkToken]['code']) {
                $exact = true;
                $checkIndent = $currentIndent;
                $checkIndent = (int)(ceil($checkIndent / $this->indent) * $this->indent);
            }

            // Special case for ELSE statements that are not on the same
            // line as the previous IF statements closing brace. They still need
            // to have the same indent or it will break code after the block.
            if (null !== $checkToken && T_ELSE === $tokens[$checkToken]['code']) {
                $exact = true;
            }

            // Don't perform strict checking on chained method calls since they
            // are often covered by custom rules.
            if (null !== $checkToken
                && (T_OBJECT_OPERATOR === $tokens[$checkToken]['code']
                || T_NULLSAFE_OBJECT_OPERATOR === $tokens[$checkToken]['code'])
                && true === $exact
            ) {
                $exact = false;
            }

            if (null === $checkIndent) {
                $checkIndent = $currentIndent;
            }

            /*
                The indent of the line is checked by the following IF block.

                Up until now, we've just been figuring out what the indent
                of this line should be.

                After this IF block, we adjust the indent again for
                the checking of future lines
            */

            if (null !== $checkToken
                && false === isset($this->ignoreIndentation[$tokens[$checkToken]['code']])
                && (($tokenIndent !== $checkIndent && true === $exact)
                || ($tokenIndent < $checkIndent && false === $exact))
            ) {
                $type = 'IncorrectExact';
                $error = 'Line indented incorrectly; expected ';
                if (false === $exact) {
                    $error .= 'at least ';
                    $type = 'Incorrect';
                }

                if (true === $this->tabIndent) {
                    $error .= '%s tabs, found %s';
                    $data = [
                        floor($checkIndent / $this->tabWidth),
                        floor($tokenIndent / $this->tabWidth),
                    ];
                } else {
                    $error .= '%s spaces, found %s';
                    $data = [
                        $checkIndent,
                        $tokenIndent,
                    ];
                }

                if (true === $this->debug) {
                    $line = $tokens[$checkToken]['line'];
                    $message = vsprintf($error, $data);
                    echo "[Line {$line}] {$message}" . PHP_EOL;
                }

                // Assume the change would be applied and continue
                // checking indents under this assumption. This gives more
                // technically accurate error messages.
                $adjustments[$checkToken] = ($checkIndent - $tokenIndent);

                $fix = $phpcsFile->addFixableError($error, $checkToken, $type, $data);
                if (true === $fix || true === $this->debug) {
                    $accepted = $this->adjustIndent($phpcsFile, $checkToken, $checkIndent, ($checkIndent - $tokenIndent));

                    if (true === $accepted && true === $this->debug) {
                        $line = $tokens[$checkToken]['line'];
                        $type = $tokens[$checkToken]['type'];
                        echo "\t=> add adjustment of " . $adjustments[$checkToken] . " for token {$checkToken} ({$type}) on line {$line}" . PHP_EOL;
                    }
                }
            }//end if

            if (null !== $checkToken) {
                $i = $checkToken;
            }

            // Don't check indents exactly between arrays as they tend to have custom rules.
            if (T_OPEN_SHORT_ARRAY === $tokens[$i]['code']) {
                $disableExactEnd = max($disableExactEnd, $tokens[$i]['bracket_closer']);
                if (true === $this->debug) {
                    $line = $tokens[$i]['line'];
                    $type = $tokens[$disableExactEnd]['type'];
                    echo "Opening short array bracket found on line {$line}" . PHP_EOL;
                    if ($disableExactEnd === $tokens[$i]['bracket_closer']) {
                        echo "\t=> disabling exact indent checking until {$disableExactEnd} ({$type})" . PHP_EOL;
                    } else {
                        echo "\t=> continuing to disable exact indent checking until {$disableExactEnd} ({$type})" . PHP_EOL;
                    }
                }
            }

            // Completely skip here/now docs as the indent is a part of the
            // content itself.
            if (T_START_HEREDOC === $tokens[$i]['code']
                || T_START_NOWDOC === $tokens[$i]['code']
            ) {
                if (true === $this->debug) {
                    $line = $tokens[$i]['line'];
                    $type = $tokens[$disableExactEnd]['type'];
                    echo "Here/nowdoc found on line {$line}" . PHP_EOL;
                }

                $i = $phpcsFile->findNext([T_END_HEREDOC, T_END_NOWDOC], ($i + 1));
                $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($i + 1), null, true);
                if (T_COMMA === $tokens[$next]['code']) {
                    $i = $next;
                }

                if (true === $this->debug) {
                    $line = $tokens[$i]['line'];
                    $type = $tokens[$i]['type'];
                    echo "\t* skipping to token {$i} ({$type}) on line {$line} *" . PHP_EOL;
                }

                continue;
            }//end if

            // Completely skip multi-line strings as the indent is a part of the
            // content itself.
            if (T_CONSTANT_ENCAPSED_STRING === $tokens[$i]['code']
                || T_DOUBLE_QUOTED_STRING === $tokens[$i]['code']
            ) {
                $i = $phpcsFile->findNext($tokens[$i]['code'], ($i + 1), null, true);
                --$i;

                continue;
            }

            // Completely skip doc comments as they tend to have complex
            // indentation rules.
            if (T_DOC_COMMENT_OPEN_TAG === $tokens[$i]['code']) {
                $i = $tokens[$i]['comment_closer'];

                continue;
            }

            // Open tags reset the indent level.
            if (T_OPEN_TAG === $tokens[$i]['code']
                || T_OPEN_TAG_WITH_ECHO === $tokens[$i]['code']
            ) {
                if (true === $this->debug) {
                    $line = $tokens[$i]['line'];
                    echo "Open PHP tag found on line {$line}" . PHP_EOL;
                }

                if (null === $checkToken) {
                    $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $i, true);
                    $currentIndent = (\strlen($tokens[$first]['content']) - \strlen(ltrim($tokens[$first]['content'])));
                } else {
                    $currentIndent = ($tokens[$i]['column'] - 1);
                }

                $lastOpenTag = $i;

                if (true === isset($adjustments[$i])) {
                    $currentIndent += $adjustments[$i];
                }

                // Make sure it is divisible by our expected indent.
                $currentIndent = (int)(ceil($currentIndent / $this->indent) * $this->indent);
                $setIndents[$i] = $currentIndent;

                if (true === $this->debug) {
                    $type = $tokens[$i]['type'];
                    echo "\t=> indent set to {$currentIndent} by token {$i} ({$type})" . PHP_EOL;
                }

                continue;
            }//end if

            // Close tags reset the indent level, unless they are closing a tag
            // opened on the same line.
            if (T_CLOSE_TAG === $tokens[$i]['code']) {
                if (true === $this->debug) {
                    $line = $tokens[$i]['line'];
                    echo "Close PHP tag found on line {$line}" . PHP_EOL;
                }

                if ($tokens[$lastOpenTag]['line'] !== $tokens[$i]['line']) {
                    $currentIndent = ($tokens[$i]['column'] - 1);
                    $lastCloseTag = $i;
                } else {
                    if (null === $lastCloseTag) {
                        $currentIndent = 0;
                    } else {
                        $currentIndent = ($tokens[$lastCloseTag]['column'] - 1);
                    }
                }

                if (true === isset($adjustments[$i])) {
                    $currentIndent += $adjustments[$i];
                }

                // Make sure it is divisible by our expected indent.
                $currentIndent = (int)(ceil($currentIndent / $this->indent) * $this->indent);
                $setIndents[$i] = $currentIndent;

                if (true === $this->debug) {
                    $type = $tokens[$i]['type'];
                    echo "\t=> indent set to {$currentIndent} by token {$i} ({$type})" . PHP_EOL;
                }

                continue;
            }//end if

            // Anon classes and functions set the indent based on their own indent level.
            if (T_CLOSURE === $tokens[$i]['code'] || T_ANON_CLASS === $tokens[$i]['code']) {
                $closer = $tokens[$i]['scope_closer'];
                if ($tokens[$i]['line'] === $tokens[$closer]['line']) {
                    if (true === $this->debug) {
                        $type = str_replace('_', ' ', strtolower(substr($tokens[$i]['type'], 2)));
                        $line = $tokens[$i]['line'];
                        echo "* ignoring single-line {$type} on line {$line} *" . PHP_EOL;
                    }

                    $i = $closer;

                    continue;
                }

                if (true === $this->debug) {
                    $type = str_replace('_', ' ', strtolower(substr($tokens[$i]['type'], 2)));
                    $line = $tokens[$i]['line'];
                    echo "Open {$type} on line {$line}" . PHP_EOL;
                }

                $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $i, true);
                if (true === $this->debug) {
                    $line = $tokens[$first]['line'];
                    $type = $tokens[$first]['type'];
                    echo "\t* first token is {$first} ({$type}) on line {$line} *" . PHP_EOL;
                }

                while (T_CONSTANT_ENCAPSED_STRING === $tokens[$first]['code']
                    && T_CONSTANT_ENCAPSED_STRING === $tokens[($first - 1)]['code']
                ) {
                    $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, ($first - 1), true);
                    if (true === $this->debug) {
                        $line = $tokens[$first]['line'];
                        $type = $tokens[$first]['type'];
                        echo "\t* found multi-line string; amended first token is {$first} ({$type}) on line {$line} *" . PHP_EOL;
                    }
                }

                $currentIndent = (($tokens[$first]['column'] - 1) + $this->indent);
                $openScopes[$tokens[$i]['scope_closer']] = $tokens[$i]['scope_condition'];
                if (true === $this->debug) {
                    $closerToken = $tokens[$i]['scope_closer'];
                    $closerLine = $tokens[$closerToken]['line'];
                    $closerType = $tokens[$closerToken]['type'];
                    $conditionToken = $tokens[$i]['scope_condition'];
                    $conditionLine = $tokens[$conditionToken]['line'];
                    $conditionType = $tokens[$conditionToken]['type'];
                    echo "\t=> added open scope {$closerToken} ({$closerType}) on line {$closerLine}, pointing to condition {$conditionToken} ({$conditionType}) on line {$conditionLine}" . PHP_EOL;
                }

                if (true === isset($adjustments[$first])) {
                    $currentIndent += $adjustments[$first];
                }

                // Make sure it is divisible by our expected indent.
                $currentIndent = (int)(floor($currentIndent / $this->indent) * $this->indent);
                $i = $tokens[$i]['scope_opener'];
                $setIndents[$i] = $currentIndent;

                if (true === $this->debug) {
                    $type = $tokens[$i]['type'];
                    echo "\t=> indent set to {$currentIndent} by token {$i} ({$type})" . PHP_EOL;
                }

                continue;
            }//end if

            // Scope openers increase the indent level.
            if (true === isset($tokens[$i]['scope_condition'])
                && true === isset($tokens[$i]['scope_opener'])
                && $tokens[$i]['scope_opener'] === $i
            ) {
                $closer = $tokens[$i]['scope_closer'];
                if ($tokens[$i]['line'] === $tokens[$closer]['line']) {
                    if (true === $this->debug) {
                        $line = $tokens[$i]['line'];
                        $type = $tokens[$i]['type'];
                        echo "* ignoring single-line {$type} on line {$line} *" . PHP_EOL;
                    }

                    $i = $closer;

                    continue;
                }

                $condition = $tokens[$tokens[$i]['scope_condition']]['code'];
                if (T_FN === $condition) {
                    if (true === $this->debug) {
                        $line = $tokens[$tokens[$i]['scope_condition']]['line'];
                        echo "* ignoring arrow function on line {$line} *" . PHP_EOL;
                    }

                    $i = $closer;

                    continue;
                }

                if (true === isset(Tokens::$scopeOpeners[$condition])
                    && false === \in_array($condition, $this->nonIndentingScopes, true)
                ) {
                    if (true === $this->debug) {
                        $line = $tokens[$i]['line'];
                        $type = $tokens[$tokens[$i]['scope_condition']]['type'];
                        echo "Open scope ({$type}) on line {$line}" . PHP_EOL;
                    }

                    $currentIndent += $this->indent;
                    $setIndents[$i] = $currentIndent;
                    $openScopes[$tokens[$i]['scope_closer']] = $tokens[$i]['scope_condition'];
                    if (true === $this->debug) {
                        $closerToken = $tokens[$i]['scope_closer'];
                        $closerLine = $tokens[$closerToken]['line'];
                        $closerType = $tokens[$closerToken]['type'];
                        $conditionToken = $tokens[$i]['scope_condition'];
                        $conditionLine = $tokens[$conditionToken]['line'];
                        $conditionType = $tokens[$conditionToken]['type'];
                        echo "\t=> added open scope {$closerToken} ({$closerType}) on line {$closerLine}, pointing to condition {$conditionToken} ({$conditionType}) on line {$conditionLine}" . PHP_EOL;
                    }

                    if (true === $this->debug) {
                        $type = $tokens[$i]['type'];
                        echo "\t=> indent set to {$currentIndent} by token {$i} ({$type})" . PHP_EOL;
                    }

                    continue;
                }//end if
            }//end if

            // JS objects set the indent level.
            if ('JS' === $phpcsFile->tokenizerType
                && T_OBJECT === $tokens[$i]['code']
            ) {
                $closer = $tokens[$i]['bracket_closer'];
                if ($tokens[$i]['line'] === $tokens[$closer]['line']) {
                    if (true === $this->debug) {
                        $line = $tokens[$i]['line'];
                        echo "* ignoring single-line JS object on line {$line} *" . PHP_EOL;
                    }

                    $i = $closer;

                    continue;
                }

                if (true === $this->debug) {
                    $line = $tokens[$i]['line'];
                    echo "Open JS object on line {$line}" . PHP_EOL;
                }

                $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $i, true);
                $currentIndent = (($tokens[$first]['column'] - 1) + $this->indent);
                if (true === isset($adjustments[$first])) {
                    $currentIndent += $adjustments[$first];
                }

                // Make sure it is divisible by our expected indent.
                $currentIndent = (int)(ceil($currentIndent / $this->indent) * $this->indent);
                $setIndents[$first] = $currentIndent;

                if (true === $this->debug) {
                    $type = $tokens[$first]['type'];
                    echo "\t=> indent set to {$currentIndent} by token {$first} ({$type})" . PHP_EOL;
                }

                continue;
            }//end if

            // Closing an anon class or function.
            if (true === isset($tokens[$i]['scope_condition'])
                && $tokens[$i]['scope_closer'] === $i
                && (T_CLOSURE === $tokens[$tokens[$i]['scope_condition']]['code']
                || T_ANON_CLASS === $tokens[$tokens[$i]['scope_condition']]['code'])
            ) {
                if (true === $this->debug) {
                    $type = str_replace('_', ' ', strtolower(substr($tokens[$tokens[$i]['scope_condition']]['type'], 2)));
                    $line = $tokens[$i]['line'];
                    echo "Close {$type} on line {$line}" . PHP_EOL;
                }

                $prev = false;

                $object = 0;
                if ('JS' === $phpcsFile->tokenizerType) {
                    $conditions = $tokens[$i]['conditions'];
                    krsort($conditions, SORT_NUMERIC);
                    foreach ($conditions as $token => $condition) {
                        if (T_OBJECT === $condition) {
                            $object = $token;

                            break;
                        }
                    }

                    if (true === $this->debug && 0 !== $object) {
                        $line = $tokens[$object]['line'];
                        echo "\t* token is inside JS object {$object} on line {$line} *" . PHP_EOL;
                    }
                }

                $parens = 0;
                if (true === isset($tokens[$i]['nested_parenthesis'])
                    && false === empty($tokens[$i]['nested_parenthesis'])
                ) {
                    $parens = $tokens[$i]['nested_parenthesis'];
                    end($parens);
                    $parens = key($parens);
                    if (true === $this->debug) {
                        $line = $tokens[$parens]['line'];
                        echo "\t* token has nested parenthesis {$parens} on line {$line} *" . PHP_EOL;
                    }
                }

                $condition = 0;
                if (true === isset($tokens[$i]['conditions'])
                    && false === empty($tokens[$i]['conditions'])
                ) {
                    $condition = $tokens[$i]['conditions'];
                    end($condition);
                    $condition = key($condition);
                    if (true === $this->debug) {
                        $line = $tokens[$condition]['line'];
                        $type = $tokens[$condition]['type'];
                        echo "\t* token is inside condition {$condition} ({$type}) on line {$line} *" . PHP_EOL;
                    }
                }

                if ($parens > $object && $parens > $condition) {
                    if (true === $this->debug) {
                        echo "\t* using parenthesis *" . PHP_EOL;
                    }

                    $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($parens - 1), null, true);
                    $object = 0;
                    $condition = 0;
                } elseif ($object > 0 && $object >= $condition) {
                    if (true === $this->debug) {
                        echo "\t* using object *" . PHP_EOL;
                    }

                    $prev = $object;
                    $parens = 0;
                    $condition = 0;
                } elseif ($condition > 0) {
                    if (true === $this->debug) {
                        echo "\t* using condition *" . PHP_EOL;
                    }

                    $prev = $condition;
                    $object = 0;
                    $parens = 0;
                }//end if

                if (false === $prev) {
                    $prev = $phpcsFile->findPrevious([T_EQUAL, T_RETURN], ($tokens[$i]['scope_condition'] - 1), null, false, null, true);
                    if (false === $prev) {
                        $prev = $i;
                        if (true === $this->debug) {
                            echo "\t* could not find a previous T_EQUAL or T_RETURN token; will use current token *" . PHP_EOL;
                        }
                    }
                }

                if (true === $this->debug) {
                    $line = $tokens[$prev]['line'];
                    $type = $tokens[$prev]['type'];
                    echo "\t* previous token is {$type} on line {$line} *" . PHP_EOL;
                }

                $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $prev, true);
                if (true === $this->debug) {
                    $line = $tokens[$first]['line'];
                    $type = $tokens[$first]['type'];
                    echo "\t* first token on line {$line} is {$first} ({$type}) *" . PHP_EOL;
                }

                $prev = $phpcsFile->findStartOfStatement($first);
                if ($prev !== $first) {
                    // This is not the start of the statement.
                    if (true === $this->debug) {
                        $line = $tokens[$prev]['line'];
                        $type = $tokens[$prev]['type'];
                        echo "\t* amended previous is {$type} on line {$line} *" . PHP_EOL;
                    }

                    $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $prev, true);
                    if (true === $this->debug) {
                        $line = $tokens[$first]['line'];
                        $type = $tokens[$first]['type'];
                        echo "\t* amended first token is {$first} ({$type}) on line {$line} *" . PHP_EOL;
                    }
                }

                $currentIndent = ($tokens[$first]['column'] - 1);
                if ($object > 0 || $condition > 0) {
                    $currentIndent += $this->indent;
                }

                if (true === isset($tokens[$first]['scope_closer'])
                    && $tokens[$first]['scope_closer'] === $first
                ) {
                    if (true === $this->debug) {
                        echo "\t* first token is a scope closer *" . PHP_EOL;
                    }

                    if (0 === $condition || $tokens[$condition]['scope_opener'] < $first) {
                        $currentIndent = $setIndents[$first];
                    } elseif (true === $this->debug) {
                        echo "\t* ignoring scope closer *" . PHP_EOL;
                    }
                }

                // Make sure it is divisible by our expected indent.
                $currentIndent = (int)(ceil($currentIndent / $this->indent) * $this->indent);
                $setIndents[$first] = $currentIndent;

                if (true === $this->debug) {
                    $type = $tokens[$first]['type'];
                    echo "\t=> indent set to {$currentIndent} by token {$first} ({$type})" . PHP_EOL;
                }
            }//end if
        }//end for

        // Don't process the rest of the file.
        return $phpcsFile->numTokens;
    }

    //end process()

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile All the tokens found in the document.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     * @param int                         $length    The length of the new indent.
     * @param int                         $change    The difference in length between
     *                                               the old and new indent.
     *
     * @return bool
     */
    protected function adjustIndent(File $phpcsFile, $stackPtr, $length, $change)
    {
        $tokens = $phpcsFile->getTokens();

        // We don't adjust indents outside of PHP.
        if (T_INLINE_HTML === $tokens[$stackPtr]['code']) {
            return false;
        }

        $padding = '';
        if ($length > 0) {
            if (true === $this->tabIndent) {
                $numTabs = floor($length / $this->tabWidth);
                if ($numTabs > 0) {
                    $numSpaces = ($length - ($numTabs * $this->tabWidth));
                    $padding = str_repeat("\t", $numTabs) . str_repeat(' ', $numSpaces);
                }
            } else {
                $padding = str_repeat(' ', $length);
            }
        }

        if (1 === $tokens[$stackPtr]['column']) {
            $trimmed = ltrim($tokens[$stackPtr]['content']);
            $accepted = $phpcsFile->fixer->replaceToken($stackPtr, $padding . $trimmed);
        } else {
            // Easier to just replace the entire indent.
            $accepted = $phpcsFile->fixer->replaceToken(($stackPtr - 1), $padding);
        }

        if (false === $accepted) {
            return false;
        }

        if (T_DOC_COMMENT_OPEN_TAG === $tokens[$stackPtr]['code']) {
            // We adjusted the start of a comment, so adjust the rest of it
            // as well so the alignment remains correct.
            for ($x = ($stackPtr + 1); $x < $tokens[$stackPtr]['comment_closer']; ++$x) {
                if (1 !== $tokens[$x]['column']) {
                    continue;
                }

                $length = 0;
                if (T_DOC_COMMENT_WHITESPACE === $tokens[$x]['code']) {
                    $length = $tokens[$x]['length'];
                }

                $padding = ($length + $change);
                if ($padding > 0) {
                    if (true === $this->tabIndent) {
                        $numTabs = floor($padding / $this->tabWidth);
                        $numSpaces = ($padding - ($numTabs * $this->tabWidth));
                        $padding = str_repeat("\t", $numTabs) . str_repeat(' ', $numSpaces);
                    } else {
                        $padding = str_repeat(' ', $padding);
                    }
                } else {
                    $padding = '';
                }

                $phpcsFile->fixer->replaceToken($x, $padding);
                if (true === $this->debug) {
                    $length = \strlen($padding);
                    $line = $tokens[$x]['line'];
                    $type = $tokens[$x]['type'];
                    echo "\t=> Indent adjusted to {$length} for {$type} on line {$line}" . PHP_EOL;
                }
            }//end for
        }//end if

        return true;
    }

    //end adjustIndent()
}//end class
