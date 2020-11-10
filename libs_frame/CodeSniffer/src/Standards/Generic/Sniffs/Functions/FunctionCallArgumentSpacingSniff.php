<?php
/**
 * Checks that calls to methods and functions are spaced correctly.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\Functions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class FunctionCallArgumentSpacingSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return[
            T_STRING,
            T_ISSET,
            T_UNSET,
            T_SELF,
            T_STATIC,
            T_VARIABLE,
            T_CLOSE_CURLY_BRACKET,
            T_CLOSE_PARENTHESIS,
        ];
    }

    //end register()

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in the
     *                                               stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Skip tokens that are the names of functions or classes
        // within their definitions. For example:
        // function myFunction...
        // "myFunction" is T_STRING but we should skip because it is not a
        // function or method *call*.
        $functionName = $stackPtr;
        $ignoreTokens = Tokens::$emptyTokens;
        $ignoreTokens[] = T_BITWISE_AND;
        $functionKeyword = $phpcsFile->findPrevious($ignoreTokens, ($stackPtr - 1), null, true);
        if (T_FUNCTION === $tokens[$functionKeyword]['code'] || T_CLASS === $tokens[$functionKeyword]['code']) {
            return;
        }

        if (T_CLOSE_CURLY_BRACKET === $tokens[$stackPtr]['code']
            && true === isset($tokens[$stackPtr]['scope_condition'])
        ) {
            // Not a function call.
            return;
        }

        // If the next non-whitespace token after the function or method call
        // is not an opening parenthesis then it can't really be a *call*.
        $openBracket = $phpcsFile->findNext(Tokens::$emptyTokens, ($functionName + 1), null, true);
        if (T_OPEN_PARENTHESIS !== $tokens[$openBracket]['code']) {
            return;
        }

        if (false === isset($tokens[$openBracket]['parenthesis_closer'])) {
            return;
        }

        $this->checkSpacing($phpcsFile, $stackPtr, $openBracket);
    }

    //end process()

    /**
     * Checks the spacing around commas.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile   The file being scanned.
     * @param int                         $stackPtr    The position of the current token in the
     *                                                 stack passed in $tokens.
     * @param int                         $openBracket The position of the opening bracket
     *                                                 in the stack passed in $tokens.
     */
    public function checkSpacing(File $phpcsFile, $stackPtr, $openBracket)
    {
        $tokens = $phpcsFile->getTokens();

        $closeBracket = $tokens[$openBracket]['parenthesis_closer'];
        $nextSeparator = $openBracket;

        $find = [
            T_COMMA,
            T_CLOSURE,
            T_ANON_CLASS,
            T_OPEN_SHORT_ARRAY,
        ];

        while (($nextSeparator = $phpcsFile->findNext($find, ($nextSeparator + 1), $closeBracket)) !== false) {
            if (T_CLOSURE === $tokens[$nextSeparator]['code']
                || T_ANON_CLASS === $tokens[$nextSeparator]['code']
            ) {
                // Skip closures.
                $nextSeparator = $tokens[$nextSeparator]['scope_closer'];

                continue;
            }
            if (T_OPEN_SHORT_ARRAY === $tokens[$nextSeparator]['code']) {
                // Skips arrays using short notation.
                $nextSeparator = $tokens[$nextSeparator]['bracket_closer'];

                continue;
            }

            // Make sure the comma or variable belongs directly to this function call,
            // and is not inside a nested function call or array.
            $brackets = $tokens[$nextSeparator]['nested_parenthesis'];
            $lastBracket = array_pop($brackets);
            if ($lastBracket !== $closeBracket) {
                continue;
            }

            if (T_COMMA === $tokens[$nextSeparator]['code']) {
                if (T_WHITESPACE === $tokens[($nextSeparator - 1)]['code']) {
                    $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($nextSeparator - 2), null, true);
                    if (false === isset(Tokens::$heredocTokens[$tokens[$prev]['code']])) {
                        $error = 'Space found before comma in argument list';
                        $fix = $phpcsFile->addFixableError($error, $nextSeparator, 'SpaceBeforeComma');
                        if (true === $fix) {
                            $phpcsFile->fixer->beginChangeset();

                            if ($tokens[$prev]['line'] !== $tokens[$nextSeparator]['line']) {
                                $phpcsFile->fixer->addContent($prev, ',');
                                $phpcsFile->fixer->replaceToken($nextSeparator, '');
                            } else {
                                $phpcsFile->fixer->replaceToken(($nextSeparator - 1), '');
                            }

                            $phpcsFile->fixer->endChangeset();
                        }
                    }//end if
                }//end if

                if (T_WHITESPACE !== $tokens[($nextSeparator + 1)]['code']) {
                    $error = 'No space found after comma in argument list';
                    $fix = $phpcsFile->addFixableError($error, $nextSeparator, 'NoSpaceAfterComma');
                    if (true === $fix) {
                        $phpcsFile->fixer->addContent($nextSeparator, ' ');
                    }
                } else {
                    // If there is a newline in the space, then they must be formatting
                    // each argument on a newline, which is valid, so ignore it.
                    $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($nextSeparator + 1), null, true);
                    if ($tokens[$next]['line'] === $tokens[$nextSeparator]['line']) {
                        $space = $tokens[($nextSeparator + 1)]['length'];
                        if ($space > 1) {
                            $error = 'Expected 1 space after comma in argument list; %s found';
                            $data = [$space];
                            $fix = $phpcsFile->addFixableError($error, $nextSeparator, 'TooMuchSpaceAfterComma', $data);
                            if (true === $fix) {
                                $phpcsFile->fixer->replaceToken(($nextSeparator + 1), ' ');
                            }
                        }
                    }
                }//end if
            }//end if
        }//end while
    }

    //end checkSpacing()
}//end class
