<?php
/**
 * Ensure there is a single space after scope keywords.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class ScopeKeywordSpacingSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        $register = Tokens::$scopeModifiers;
        $register[] = T_STATIC;

        return $register;
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

        if (false === isset($tokens[($stackPtr + 1)])) {
            return;
        }

        $prevToken = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
        $nextToken = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);

        if (T_STATIC === $tokens[$stackPtr]['code']
            && ((false === $nextToken || T_DOUBLE_COLON === $tokens[$nextToken]['code'])
            || T_NEW === $tokens[$prevToken]['code'])
        ) {
            // Late static binding, e.g., static:: OR new static() usage or live coding.
            return;
        }

        if (T_AS === $tokens[$prevToken]['code']) {
            // Trait visibility change, e.g., "use HelloWorld { sayHello as private; }".
            return;
        }

        if (false !== $nextToken && T_VARIABLE === $tokens[$nextToken]['code']) {
            $endOfStatement = $phpcsFile->findNext(T_SEMICOLON, ($nextToken + 1));
            if (false === $endOfStatement) {
                // Live coding.
                return;
            }

            $multiProperty = $phpcsFile->findNext(T_VARIABLE, ($nextToken + 1), $endOfStatement);
            if (false !== $multiProperty
                && $tokens[$stackPtr]['line'] !== $tokens[$nextToken]['line']
                && $tokens[$nextToken]['line'] !== $tokens[$endOfStatement]['line']
            ) {
                // Allow for multiple properties definitions to each be on their own line.
                return;
            }
        }

        if (T_WHITESPACE !== $tokens[($stackPtr + 1)]['code']) {
            $spacing = 0;
        } else {
            if ($tokens[($stackPtr + 2)]['line'] !== $tokens[$stackPtr]['line']) {
                $spacing = 'newline';
            } else {
                $spacing = $tokens[($stackPtr + 1)]['length'];
            }
        }

        if (1 !== $spacing) {
            $error = 'Scope keyword "%s" must be followed by a single space; found %s';
            $data = [
                $tokens[$stackPtr]['content'],
                $spacing,
            ];

            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'Incorrect', $data);
            if (true === $fix) {
                if (0 === $spacing) {
                    $phpcsFile->fixer->addContent($stackPtr, ' ');
                } else {
                    $phpcsFile->fixer->beginChangeset();

                    for ($i = ($stackPtr + 2); $i < $phpcsFile->numTokens; ++$i) {
                        if (false === isset($tokens[$i]) || T_WHITESPACE !== $tokens[$i]['code']) {
                            break;
                        }

                        $phpcsFile->fixer->replaceToken($i, '');
                    }

                    $phpcsFile->fixer->replaceToken(($stackPtr + 1), ' ');
                    $phpcsFile->fixer->endChangeset();
                }
            }//end if
        }//end if
    }

    //end process()
}//end class
