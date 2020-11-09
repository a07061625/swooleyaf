<?php
/**
 * A Sniff to enforce the use of IDENTICAL type operators rather than EQUAL operators.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\Operators;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class ComparisonOperatorUsageSniff implements Sniff
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
     * A list of valid comparison operators.
     *
     * @var array
     */
    private static $validOps = [
        T_IS_IDENTICAL => true,
        T_IS_NOT_IDENTICAL => true,
        T_LESS_THAN => true,
        T_GREATER_THAN => true,
        T_IS_GREATER_OR_EQUAL => true,
        T_IS_SMALLER_OR_EQUAL => true,
        T_INSTANCEOF => true,
    ];

    /**
     * A list of invalid operators with their alternatives.
     *
     * @var array<int, string>
     */
    private static $invalidOps = [
        'PHP' => [
            T_IS_EQUAL => '===',
            T_IS_NOT_EQUAL => '!==',
            T_BOOLEAN_NOT => '=== FALSE',
        ],
        'JS' => [
            T_IS_EQUAL => '===',
            T_IS_NOT_EQUAL => '!==',
        ],
    ];

    /**
     * Registers the token types that this sniff wishes to listen to.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_IF,
            T_ELSEIF,
            T_INLINE_THEN,
            T_WHILE,
            T_FOR,
        ];
    }

    //end register()

    /**
     * Process the tokens that this sniff is listening for.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file where the token was found.
     * @param int                         $stackPtr  The position in the stack where the token
     *                                               was found.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $tokenizer = $phpcsFile->tokenizerType;

        if (T_INLINE_THEN === $tokens[$stackPtr]['code']) {
            $end = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
            if (T_CLOSE_PARENTHESIS !== $tokens[$end]['code']) {
                // This inline IF statement does not have its condition
                // bracketed, so we need to guess where it starts.
                for ($i = ($end - 1); $i >= 0; --$i) {
                    if (T_SEMICOLON === $tokens[$i]['code']) {
                        // Stop here as we assume it is the end
                        // of the previous statement.
                        break;
                    }
                    if (T_OPEN_TAG === $tokens[$i]['code']) {
                        // Stop here as this is the start of the file.
                        break;
                    }
                    if (T_CLOSE_CURLY_BRACKET === $tokens[$i]['code']) {
                        // Stop if this is the closing brace of
                        // a code block.
                        if (true === isset($tokens[$i]['scope_opener'])) {
                            break;
                        }
                    } elseif (T_OPEN_CURLY_BRACKET === $tokens[$i]['code']) {
                        // Stop if this is the opening brace of
                        // a code block.
                        if (true === isset($tokens[$i]['scope_closer'])) {
                            break;
                        }
                    } elseif (T_OPEN_PARENTHESIS === $tokens[$i]['code']) {
                        // Stop if this is the start of a pair of
                        // parentheses that surrounds the inline
                        // IF statement.
                        if (true === isset($tokens[$i]['parenthesis_closer'])
                            && $tokens[$i]['parenthesis_closer'] >= $stackPtr
                        ) {
                            break;
                        }
                    }//end if
                }//end for

                $start = $phpcsFile->findNext(Tokens::$emptyTokens, ($i + 1), null, true);
            } else {
                if (false === isset($tokens[$end]['parenthesis_opener'])) {
                    return;
                }

                $start = $tokens[$end]['parenthesis_opener'];
            }//end if
        } elseif (T_FOR === $tokens[$stackPtr]['code']) {
            if (false === isset($tokens[$stackPtr]['parenthesis_opener'])) {
                return;
            }

            $openingBracket = $tokens[$stackPtr]['parenthesis_opener'];
            $closingBracket = $tokens[$stackPtr]['parenthesis_closer'];

            $start = $phpcsFile->findNext(T_SEMICOLON, $openingBracket, $closingBracket);
            $end = $phpcsFile->findNext(T_SEMICOLON, ($start + 1), $closingBracket);
            if (false === $start || false === $end) {
                return;
            }
        } else {
            if (false === isset($tokens[$stackPtr]['parenthesis_opener'])) {
                return;
            }

            $start = $tokens[$stackPtr]['parenthesis_opener'];
            $end = $tokens[$stackPtr]['parenthesis_closer'];
        }//end if

        $requiredOps = 0;
        $foundOps = 0;
        $foundBooleans = 0;

        $lastNonEmpty = $start;

        for ($i = $start; $i <= $end; ++$i) {
            $type = $tokens[$i]['code'];
            if (true === isset(self::$invalidOps[$tokenizer][$type])) {
                $error = 'Operator %s prohibited; use %s instead';
                $data = [
                    $tokens[$i]['content'],
                    self::$invalidOps[$tokenizer][$type],
                ];
                $phpcsFile->addError($error, $i, 'NotAllowed', $data);
                ++$foundOps;
            } elseif (true === isset(self::$validOps[$type])) {
                ++$foundOps;
            }

            if (T_OPEN_PARENTHESIS === $type
                && true === isset($tokens[$i]['parenthesis_closer'])
                && true === isset(Tokens::$functionNameTokens[$tokens[$lastNonEmpty]['code']])
            ) {
                $i = $tokens[$i]['parenthesis_closer'];
                $lastNonEmpty = $i;

                continue;
            }

            if (T_TRUE === $tokens[$i]['code'] || T_FALSE === $tokens[$i]['code']) {
                ++$foundBooleans;
            }

            if ('JS' !== $phpcsFile->tokenizerType
                && (T_BOOLEAN_AND === $tokens[$i]['code']
                || T_BOOLEAN_OR === $tokens[$i]['code'])
            ) {
                ++$requiredOps;

                // When the instanceof operator is used with another operator
                // like ===, you can get more ops than are required.
                if ($foundOps > $requiredOps) {
                    $foundOps = $requiredOps;
                }

                // If we get to here and we have not found the right number of
                // comparison operators, then we must have had an implicit
                // true operation i.e., if ($a) instead of the required
                // if ($a === true), so let's add an error.
                if ($requiredOps !== $foundOps) {
                    $error = 'Implicit true comparisons prohibited; use === TRUE instead';
                    $phpcsFile->addError($error, $stackPtr, 'ImplicitTrue');
                    ++$foundOps;
                }
            }

            if (false === isset(Tokens::$emptyTokens[$type])) {
                $lastNonEmpty = $i;
            }
        }//end for

        ++$requiredOps;

        if ('JS' !== $phpcsFile->tokenizerType
            && $foundOps < $requiredOps
            && ($requiredOps !== $foundBooleans)
        ) {
            $error = 'Implicit true comparisons prohibited; use === TRUE instead';
            $phpcsFile->addError($error, $stackPtr, 'ImplicitTrue');
        }
    }

    //end process()
}//end class
