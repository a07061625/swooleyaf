<?php
/**
 * Ensure there is no space before a colon and one space after it.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\CSS;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class ColonSpacingSniff implements Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = ['CSS'];

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return int[]
     */
    public function register()
    {
        return [T_COLON];
    }

    //end register()

    /**
     * Processes the tokens that this sniff is interested in.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file where the token was found.
     * @param int                         $stackPtr  The position in the stack where
     *                                               the token was found.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
        if (T_STYLE !== $tokens[$prev]['code']) {
            // The colon is not part of a style definition.
            return;
        }

        if ('progid' === $tokens[$prev]['content']) {
            // Special case for IE filters.
            return;
        }

        if (T_WHITESPACE === $tokens[($stackPtr - 1)]['code']) {
            $error = 'There must be no space before a colon in a style definition';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'Before');
            if (true === $fix) {
                $phpcsFile->fixer->replaceToken(($stackPtr - 1), '');
            }
        }

        $next = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
        if (T_SEMICOLON === $tokens[$next]['code'] || T_STYLE === $tokens[$next]['code']) {
            // Empty style definition, ignore it.
            return;
        }

        if (T_WHITESPACE !== $tokens[($stackPtr + 1)]['code']) {
            $error = 'Expected 1 space after colon in style definition; 0 found';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoneAfter');
            if (true === $fix) {
                $phpcsFile->fixer->addContent($stackPtr, ' ');
            }
        } else {
            $content = $tokens[($stackPtr + 1)]['content'];
            if (false === strpos($content, $phpcsFile->eolChar)) {
                $length = \strlen($content);
                if (1 !== $length) {
                    $error = 'Expected 1 space after colon in style definition; %s found';
                    $data = [$length];
                    $fix = $phpcsFile->addFixableError($error, $stackPtr, 'After', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($stackPtr + 1), ' ');
                    }
                }
            } else {
                $error = 'Expected 1 space after colon in style definition; newline found';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'AfterNewline');
                if (true === $fix) {
                    $phpcsFile->fixer->replaceToken(($stackPtr + 1), ' ');
                }
            }
        }//end if
    }

    //end process()
}//end class
