<?php
/**
 * Ensure there is a single blank line after the closing brace of a class definition.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\CSS;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class ClassDefinitionClosingBraceSpaceSniff implements Sniff
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
        return [T_CLOSE_CURLY_BRACKET];
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
        $next = $stackPtr;
        while (true) {
            $next = $phpcsFile->findNext(T_WHITESPACE, ($next + 1), null, true);
            if (false === $next) {
                return;
            }

            if (true === isset(Tokens::$emptyTokens[$tokens[$next]['code']])
                && $tokens[$next]['line'] === $tokens[$stackPtr]['line']
            ) {
                // Trailing comment.
                continue;
            }

            break;
        }

        if (T_CLOSE_TAG !== $tokens[$next]['code']) {
            $found = (($tokens[$next]['line'] - $tokens[$stackPtr]['line']) - 1);
            if (1 !== $found) {
                $error = 'Expected one blank line after closing brace of class definition; %s found';
                $data = [max(0, $found)];
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpacingAfterClose', $data);

                if (true === $fix) {
                    $firstOnLine = $next;
                    while (1 !== $tokens[$firstOnLine]['column']) {
                        --$firstOnLine;
                    }

                    if ($found < 0) {
                        // Next statement on same line as the closing brace.
                        $phpcsFile->fixer->addContentBefore($next, $phpcsFile->eolChar . $phpcsFile->eolChar);
                    } elseif (0 === $found) {
                        // Next statement on next line, no blank line.
                        $phpcsFile->fixer->addContentBefore($firstOnLine, $phpcsFile->eolChar);
                    } else {
                        // Too many blank lines.
                        $phpcsFile->fixer->beginChangeset();
                        for ($i = ($firstOnLine - 1); $i > $stackPtr; --$i) {
                            if (T_WHITESPACE !== $tokens[$i]['code']) {
                                break;
                            }

                            $phpcsFile->fixer->replaceToken($i, '');
                        }

                        $phpcsFile->fixer->addContentBefore($firstOnLine, $phpcsFile->eolChar . $phpcsFile->eolChar);
                        $phpcsFile->fixer->endChangeset();
                    }
                }//end if
            }//end if
        }//end if

        // Ignore nested style definitions from here on. The spacing before the closing brace
        // (a single blank line) will be enforced by the above check, which ensures there is a
        // blank line after the last nested class.
        $found = $phpcsFile->findPrevious(
            T_CLOSE_CURLY_BRACKET,
            ($stackPtr - 1),
            $tokens[$stackPtr]['bracket_opener']
        );

        if (false !== $found) {
            return;
        }

        $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
        if (false === $prev) {
            return;
        }

        if ($tokens[$prev]['line'] === $tokens[$stackPtr]['line']) {
            $error = 'Closing brace of class definition must be on new line';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'ContentBeforeClose');
            if (true === $fix) {
                $phpcsFile->fixer->addNewlineBefore($stackPtr);
            }
        }
    }

    //end process()
}//end class
