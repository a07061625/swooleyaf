<?php
/**
 * Checks that the closing brace of a function goes directly after the body.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\PSR2\Sniffs\Methods;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class FunctionClosingBraceSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_FUNCTION,
            T_CLOSURE,
        ];
    }

    //end register()

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (false === isset($tokens[$stackPtr]['scope_closer'])) {
            // Probably an interface method.
            return;
        }

        $closeBrace = $tokens[$stackPtr]['scope_closer'];
        $prevContent = $phpcsFile->findPrevious(T_WHITESPACE, ($closeBrace - 1), null, true);
        $found = ($tokens[$closeBrace]['line'] - $tokens[$prevContent]['line'] - 1);

        if ($found < 0) {
            // Brace isn't on a new line, so not handled by us.
            return;
        }

        if (0 === $found) {
            // All is good.
            return;
        }

        $error = 'Function closing brace must go on the next line following the body; found %s blank lines before brace';
        $data = [$found];
        $fix = $phpcsFile->addFixableError($error, $closeBrace, 'SpacingBeforeClose', $data);

        if (true === $fix) {
            $phpcsFile->fixer->beginChangeset();
            for ($i = ($prevContent + 1); $i < $closeBrace; ++$i) {
                if ($tokens[$i]['line'] === $tokens[$prevContent]['line']) {
                    continue;
                }

                // Don't remove any indentation before the brace.
                if ($tokens[$i]['line'] === $tokens[$closeBrace]['line']) {
                    break;
                }

                $phpcsFile->fixer->replaceToken($i, '');
            }

            $phpcsFile->fixer->endChangeset();
        }
    }

    //end process()
}//end class
