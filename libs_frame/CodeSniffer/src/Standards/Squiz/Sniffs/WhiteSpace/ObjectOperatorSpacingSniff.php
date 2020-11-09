<?php
/**
 * Ensure there is no whitespace before/after an object operator.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ObjectOperatorSpacingSniff implements Sniff
{
    /**
     * Allow newlines instead of spaces.
     *
     * @var bool
     */
    public $ignoreNewlines = false;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_OBJECT_OPERATOR,
            T_DOUBLE_COLON,
            T_NULLSAFE_OBJECT_OPERATOR,
        ];
    }

    //end register()

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        if (T_WHITESPACE !== $tokens[($stackPtr - 1)]['code']) {
            $before = 0;
        } else {
            if ($tokens[($stackPtr - 2)]['line'] !== $tokens[$stackPtr]['line']) {
                $before = 'newline';
            } else {
                $before = $tokens[($stackPtr - 1)]['length'];
            }
        }

        $phpcsFile->recordMetric($stackPtr, 'Spacing before object operator', $before);
        $this->checkSpacingBeforeOperator($phpcsFile, $stackPtr, $before);

        if (false === isset($tokens[($stackPtr + 1)])
            || false === isset($tokens[($stackPtr + 2)])
        ) {
            return;
        }

        if (T_WHITESPACE !== $tokens[($stackPtr + 1)]['code']) {
            $after = 0;
        } else {
            if ($tokens[($stackPtr + 2)]['line'] !== $tokens[$stackPtr]['line']) {
                $after = 'newline';
            } else {
                $after = $tokens[($stackPtr + 1)]['length'];
            }
        }

        $phpcsFile->recordMetric($stackPtr, 'Spacing after object operator', $after);
        $this->checkSpacingAfterOperator($phpcsFile, $stackPtr, $after);
    }

    //end process()

    /**
     * Check the spacing before the operator.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     * @param mixed                       $before    The number of spaces found before the
     *                                               operator or the string 'newline'.
     *
     * @return bool true if there was no error, false otherwise.
     */
    protected function checkSpacingBeforeOperator(File $phpcsFile, $stackPtr, $before)
    {
        if (0 !== $before
            && ('newline' !== $before || false === $this->ignoreNewlines)
        ) {
            $error = 'Space found before object operator';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'Before');
            if (true === $fix) {
                $tokens = $phpcsFile->getTokens();
                $curPos = ($stackPtr - 1);

                $phpcsFile->fixer->beginChangeset();
                while (T_WHITESPACE === $tokens[$curPos]['code']) {
                    $phpcsFile->fixer->replaceToken($curPos, '');
                    --$curPos;
                }

                $phpcsFile->fixer->endChangeset();
            }

            return false;
        }

        return true;
    }

    //end checkSpacingBeforeOperator()

    /**
     * Check the spacing after the operator.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     * @param mixed                       $after     The number of spaces found after the
     *                                               operator or the string 'newline'.
     *
     * @return bool true if there was no error, false otherwise.
     */
    protected function checkSpacingAfterOperator(File $phpcsFile, $stackPtr, $after)
    {
        if (0 !== $after
            && ('newline' !== $after || false === $this->ignoreNewlines)
        ) {
            $error = 'Space found after object operator';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'After');
            if (true === $fix) {
                $tokens = $phpcsFile->getTokens();
                $curPos = ($stackPtr + 1);

                $phpcsFile->fixer->beginChangeset();
                while (T_WHITESPACE === $tokens[$curPos]['code']) {
                    $phpcsFile->fixer->replaceToken($curPos, '');
                    ++$curPos;
                }

                $phpcsFile->fixer->endChangeset();
            }

            return false;
        }

        return true;
    }

    //end checkSpacingAfterOperator()
}//end class
