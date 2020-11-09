<?php
/**
 * Ensure that there are no spaces around square brackets.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ArrayBracketSpacingSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_OPEN_SQUARE_BRACKET,
            T_CLOSE_SQUARE_BRACKET,
        ];
    }

    //end register()

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The current file being checked.
     * @param int                         $stackPtr  The position of the current token in the
     *                                               stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ((T_OPEN_SQUARE_BRACKET === $tokens[$stackPtr]['code']
            && false === isset($tokens[$stackPtr]['bracket_closer']))
            || (T_CLOSE_SQUARE_BRACKET === $tokens[$stackPtr]['code']
            && false === isset($tokens[$stackPtr]['bracket_opener']))
        ) {
            // Bow out for parse error/during live coding.
            return;
        }

        // Square brackets can not have a space before them.
        $prevType = $tokens[($stackPtr - 1)]['code'];
        if (T_WHITESPACE === $prevType) {
            $nonSpace = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 2), null, true);
            $expected = $tokens[$nonSpace]['content'] . $tokens[$stackPtr]['content'];
            $found = $phpcsFile->getTokensAsString($nonSpace, ($stackPtr - $nonSpace)) . $tokens[$stackPtr]['content'];
            $error = 'Space found before square bracket; expected "%s" but found "%s"';
            $data = [
                $expected,
                $found,
            ];
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpaceBeforeBracket', $data);
            if (true === $fix) {
                $phpcsFile->fixer->replaceToken(($stackPtr - 1), '');
            }
        }

        // Open square brackets can't ever have spaces after them.
        if (T_OPEN_SQUARE_BRACKET === $tokens[$stackPtr]['code']) {
            $nextType = $tokens[($stackPtr + 1)]['code'];
            if (T_WHITESPACE === $nextType) {
                $nonSpace = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 2), null, true);
                $expected = $tokens[$stackPtr]['content'] . $tokens[$nonSpace]['content'];
                $found = $phpcsFile->getTokensAsString($stackPtr, ($nonSpace - $stackPtr + 1));
                $error = 'Space found after square bracket; expected "%s" but found "%s"';
                $data = [
                    $expected,
                    $found,
                ];
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpaceAfterBracket', $data);
                if (true === $fix) {
                    $phpcsFile->fixer->replaceToken(($stackPtr + 1), '');
                }
            }
        }
    }

    //end process()
}//end class
