<?php
/**
 * Verifies that operators have valid spacing surrounding them.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class OperatorSpacingSniff implements Sniff
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
     * Allow newlines instead of spaces.
     *
     * @var bool
     */
    public $ignoreNewlines = false;

    /**
     * Don't check spacing for assignment operators.
     *
     * This allows multiple assignment statements to be aligned.
     *
     * @var bool
     */
    public $ignoreSpacingBeforeAssignments = true;

    /**
     * A list of tokens that aren't considered as operands.
     *
     * @var string[]
     */
    private $nonOperandTokens = [];

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        /*
            First we setup an array of all the tokens that can come before
            a T_MINUS or T_PLUS token to indicate that the token is not being
            used as an operator.
        */

        // Trying to operate on a negative value; eg. ($var * -1).
        $this->nonOperandTokens = Tokens::$operators;

        // Trying to compare a negative value; eg. ($var === -1).
        $this->nonOperandTokens += Tokens::$comparisonTokens;

        // Trying to compare a negative value; eg. ($var || -1 === $b).
        $this->nonOperandTokens += Tokens::$booleanOperators;

        // Trying to assign a negative value; eg. ($var = -1).
        $this->nonOperandTokens += Tokens::$assignmentTokens;

        // Returning/printing a negative value; eg. (return -1).
        $this->nonOperandTokens += [
            T_RETURN => T_RETURN,
            T_ECHO => T_ECHO,
            T_EXIT => T_EXIT,
            T_PRINT => T_PRINT,
            T_YIELD => T_YIELD,
            T_FN_ARROW => T_FN_ARROW,
        ];

        // Trying to use a negative value; eg. myFunction($var, -2).
        $this->nonOperandTokens += [
            T_COMMA => T_COMMA,
            T_OPEN_PARENTHESIS => T_OPEN_PARENTHESIS,
            T_OPEN_SQUARE_BRACKET => T_OPEN_SQUARE_BRACKET,
            T_OPEN_SHORT_ARRAY => T_OPEN_SHORT_ARRAY,
            T_COLON => T_COLON,
            T_INLINE_THEN => T_INLINE_THEN,
            T_INLINE_ELSE => T_INLINE_ELSE,
            T_CASE => T_CASE,
            T_OPEN_CURLY_BRACKET => T_OPEN_CURLY_BRACKET,
        ];

        // Casting a negative value; eg. (array) -$a.
        $this->nonOperandTokens += Tokens::$castTokens;

        // These are the tokens the sniff is looking for.

        $targets = Tokens::$comparisonTokens;
        $targets += Tokens::$operators;
        $targets += Tokens::$assignmentTokens;
        $targets[] = T_INLINE_THEN;
        $targets[] = T_INLINE_ELSE;
        $targets[] = T_INSTANCEOF;

        return $targets;
    }

    //end register()

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The current file being checked.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (false === $this->isOperator($phpcsFile, $stackPtr)) {
            return;
        }

        if (T_BITWISE_AND === $tokens[$stackPtr]['code']) {
            // Check there is one space before the & operator.
            if (T_WHITESPACE !== $tokens[($stackPtr - 1)]['code']) {
                $error = 'Expected 1 space before "&" operator; 0 found';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoSpaceBeforeAmp');
                if (true === $fix) {
                    $phpcsFile->fixer->addContentBefore($stackPtr, ' ');
                }

                $phpcsFile->recordMetric($stackPtr, 'Space before operator', 0);
            } else {
                if ($tokens[($stackPtr - 2)]['line'] !== $tokens[$stackPtr]['line']) {
                    $found = 'newline';
                } else {
                    $found = $tokens[($stackPtr - 1)]['length'];
                }

                $phpcsFile->recordMetric($stackPtr, 'Space before operator', $found);
                if (1 !== $found
                    && ('newline' !== $found || false === $this->ignoreNewlines)
                ) {
                    $error = 'Expected 1 space before "&" operator; %s found';
                    $data = [$found];
                    $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpacingBeforeAmp', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($stackPtr - 1), ' ');
                    }
                }
            }//end if

            $hasNext = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
            if (false === $hasNext) {
                // Live coding/parse error at end of file.
                return;
            }

            // Check there is one space after the & operator.
            if (T_WHITESPACE !== $tokens[($stackPtr + 1)]['code']) {
                $error = 'Expected 1 space after "&" operator; 0 found';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoSpaceAfterAmp');
                if (true === $fix) {
                    $phpcsFile->fixer->addContent($stackPtr, ' ');
                }

                $phpcsFile->recordMetric($stackPtr, 'Space after operator', 0);
            } else {
                if ($tokens[($stackPtr + 2)]['line'] !== $tokens[$stackPtr]['line']) {
                    $found = 'newline';
                } else {
                    $found = $tokens[($stackPtr + 1)]['length'];
                }

                $phpcsFile->recordMetric($stackPtr, 'Space after operator', $found);
                if (1 !== $found
                    && ('newline' !== $found || false === $this->ignoreNewlines)
                ) {
                    $error = 'Expected 1 space after "&" operator; %s found';
                    $data = [$found];
                    $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpacingAfterAmp', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($stackPtr + 1), ' ');
                    }
                }
            }//end if

            return;
        }//end if

        $operator = $tokens[$stackPtr]['content'];

        if (T_WHITESPACE !== $tokens[($stackPtr - 1)]['code']
            && ((T_INLINE_THEN === $tokens[($stackPtr - 1)]['code']
            && T_INLINE_ELSE === $tokens[($stackPtr)]['code']) === false)
        ) {
            $error = "Expected 1 space before \"{$operator}\"; 0 found";
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoSpaceBefore');
            if (true === $fix) {
                $phpcsFile->fixer->addContentBefore($stackPtr, ' ');
            }

            $phpcsFile->recordMetric($stackPtr, 'Space before operator', 0);
        } elseif (false === isset(Tokens::$assignmentTokens[$tokens[$stackPtr]['code']])
            || false === $this->ignoreSpacingBeforeAssignments
        ) {
            // Throw an error for assignments only if enabled using the sniff property
            // because other standards allow multiple spaces to align assignments.
            if ($tokens[($stackPtr - 2)]['line'] !== $tokens[$stackPtr]['line']) {
                $found = 'newline';
            } else {
                $found = $tokens[($stackPtr - 1)]['length'];
            }

            $phpcsFile->recordMetric($stackPtr, 'Space before operator', $found);
            if (1 !== $found
                && ('newline' !== $found || false === $this->ignoreNewlines)
            ) {
                $error = 'Expected 1 space before "%s"; %s found';
                $data = [
                    $operator,
                    $found,
                ];
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpacingBefore', $data);
                if (true === $fix) {
                    $phpcsFile->fixer->beginChangeset();
                    if ('newline' === $found) {
                        $i = ($stackPtr - 2);
                        while (T_WHITESPACE === $tokens[$i]['code']) {
                            $phpcsFile->fixer->replaceToken($i, '');
                            --$i;
                        }
                    }

                    $phpcsFile->fixer->replaceToken(($stackPtr - 1), ' ');
                    $phpcsFile->fixer->endChangeset();
                }
            }//end if
        }//end if

        $hasNext = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
        if (false === $hasNext) {
            // Live coding/parse error at end of file.
            return;
        }

        if (T_WHITESPACE !== $tokens[($stackPtr + 1)]['code']) {
            // Skip short ternary such as: "$foo = $bar ?: true;".
            if ((T_INLINE_THEN === $tokens[$stackPtr]['code']
                && T_INLINE_ELSE === $tokens[($stackPtr + 1)]['code'])
            ) {
                return;
            }

            $error = "Expected 1 space after \"{$operator}\"; 0 found";
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoSpaceAfter');
            if (true === $fix) {
                $phpcsFile->fixer->addContent($stackPtr, ' ');
            }

            $phpcsFile->recordMetric($stackPtr, 'Space after operator', 0);
        } else {
            if (true === isset($tokens[($stackPtr + 2)])
                && $tokens[($stackPtr + 2)]['line'] !== $tokens[$stackPtr]['line']
            ) {
                $found = 'newline';
            } else {
                $found = $tokens[($stackPtr + 1)]['length'];
            }

            $phpcsFile->recordMetric($stackPtr, 'Space after operator', $found);
            if (1 !== $found
                && ('newline' !== $found || false === $this->ignoreNewlines)
            ) {
                $error = 'Expected 1 space after "%s"; %s found';
                $data = [
                    $operator,
                    $found,
                ];

                $nextNonWhitespace = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
                if (false !== $nextNonWhitespace
                    && true === isset(Tokens::$commentTokens[$tokens[$nextNonWhitespace]['code']])
                    && 'newline' === $found
                ) {
                    // Don't auto-fix when it's a comment or PHPCS annotation on a new line as
                    // it causes fixer conflicts and can cause the meaning of annotations to change.
                    $phpcsFile->addError($error, $stackPtr, 'SpacingAfter', $data);
                } else {
                    $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpacingAfter', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($stackPtr + 1), ' ');
                    }
                }
            }//end if
        }//end if
    }

    //end process()

    /**
     * Checks if an operator is actually a different type of token in the current context.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The current file being checked.
     * @param int                         $stackPtr  The position of the operator in
     *                                               the stack.
     *
     * @return bool
     */
    protected function isOperator(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Skip default values in function declarations.
        // Skip declare statements.
        if (T_EQUAL === $tokens[$stackPtr]['code']
            || T_MINUS === $tokens[$stackPtr]['code']
        ) {
            if (true === isset($tokens[$stackPtr]['nested_parenthesis'])) {
                $parenthesis = array_keys($tokens[$stackPtr]['nested_parenthesis']);
                $bracket = array_pop($parenthesis);
                if (true === isset($tokens[$bracket]['parenthesis_owner'])) {
                    $function = $tokens[$bracket]['parenthesis_owner'];
                    if (T_FUNCTION === $tokens[$function]['code']
                        || T_CLOSURE === $tokens[$function]['code']
                        || T_FN === $tokens[$function]['code']
                        || T_DECLARE === $tokens[$function]['code']
                    ) {
                        return false;
                    }
                }
            }
        }

        if (T_EQUAL === $tokens[$stackPtr]['code']) {
            // Skip for '=&' case.
            if (true === isset($tokens[($stackPtr + 1)])
                && T_BITWISE_AND === $tokens[($stackPtr + 1)]['code']
            ) {
                return false;
            }
        }

        if (T_BITWISE_AND === $tokens[$stackPtr]['code']) {
            // If it's not a reference, then we expect one space either side of the
            // bitwise operator.
            if (true === $phpcsFile->isReference($stackPtr)) {
                return false;
            }
        }

        if (T_MINUS === $tokens[$stackPtr]['code'] || T_PLUS === $tokens[$stackPtr]['code']) {
            // Check minus spacing, but make sure we aren't just assigning
            // a minus value or returning one.
            $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
            if (true === isset($this->nonOperandTokens[$tokens[$prev]['code']])) {
                return false;
            }
        }//end if

        return true;
    }

    //end isOperator()
}//end class
