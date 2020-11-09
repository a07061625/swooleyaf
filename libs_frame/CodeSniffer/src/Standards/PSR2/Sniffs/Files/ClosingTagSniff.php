<?php
/**
 * Checks that the file does not end with a closing tag.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\PSR2\Sniffs\Files;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class ClosingTagSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_OPEN_TAG];
    }

    //end register()

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the stack passed in $tokens.
     *
     * @return int
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Make sure this file only contains PHP code.
        for ($i = 0; $i < $phpcsFile->numTokens; ++$i) {
            if (T_INLINE_HTML === $tokens[$i]['code']
                && '' !== trim($tokens[$i]['content'])
            ) {
                return $phpcsFile->numTokens;
            }
        }

        // Find the last non-empty token.
        for ($last = ($phpcsFile->numTokens - 1); $last > 0; --$last) {
            if ('' !== trim($tokens[$last]['content'])) {
                break;
            }
        }

        if (T_CLOSE_TAG === $tokens[$last]['code']) {
            $error = 'A closing tag is not permitted at the end of a PHP file';
            $fix = $phpcsFile->addFixableError($error, $last, 'NotAllowed');
            if (true === $fix) {
                $phpcsFile->fixer->beginChangeset();
                $phpcsFile->fixer->replaceToken($last, $phpcsFile->eolChar);
                $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($last - 1), null, true);
                if (T_SEMICOLON !== $tokens[$prev]['code']
                    && T_CLOSE_CURLY_BRACKET !== $tokens[$prev]['code']
                    && T_OPEN_TAG !== $tokens[$prev]['code']
                ) {
                    $phpcsFile->fixer->addContent($prev, ';');
                }

                $phpcsFile->fixer->endChangeset();
            }

            $phpcsFile->recordMetric($stackPtr, 'PHP closing tag at end of PHP-only file', 'yes');
        } else {
            $phpcsFile->recordMetric($stackPtr, 'PHP closing tag at end of PHP-only file', 'no');
        }//end if

        // Ignore the rest of the file.
        return $phpcsFile->numTokens;
    }

    //end process()
}//end class
