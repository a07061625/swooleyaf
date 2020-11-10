<?php
/**
 * Checks the declaration of the class and its inheritance is correct.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Classes\ClassDeclarationSniff as PSR2ClassDeclarationSniff;
use PHP_CodeSniffer\Util\Tokens;

class ClassDeclarationSniff extends PSR2ClassDeclarationSniff
{
    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        // We want all the errors from the PSR2 standard, plus some of our own.
        parent::process($phpcsFile, $stackPtr);

        // Check that this is the only class or interface in the file.
        $nextClass = $phpcsFile->findNext([T_CLASS, T_INTERFACE], ($stackPtr + 1));
        if (false !== $nextClass) {
            // We have another, so an error is thrown.
            $error = 'Only one interface or class is allowed in a file';
            $phpcsFile->addError($error, $nextClass, 'MultipleClasses');
        }
    }

    //end process()

    /**
     * Processes the opening section of a class declaration.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     */
    public function processOpen(File $phpcsFile, $stackPtr)
    {
        parent::processOpen($phpcsFile, $stackPtr);

        $tokens = $phpcsFile->getTokens();

        if (T_WHITESPACE === $tokens[($stackPtr - 1)]['code']) {
            $prevContent = $tokens[($stackPtr - 1)]['content'];
            if ($prevContent !== $phpcsFile->eolChar) {
                $blankSpace = substr($prevContent, strpos($prevContent, $phpcsFile->eolChar));
                $spaces = \strlen($blankSpace);

                if (T_ABSTRACT !== $tokens[($stackPtr - 2)]['code']
                    && T_FINAL !== $tokens[($stackPtr - 2)]['code']
                ) {
                    if (0 !== $spaces) {
                        $type = strtolower($tokens[$stackPtr]['content']);
                        $error = 'Expected 0 spaces before %s keyword; %s found';
                        $data = [
                            $type,
                            $spaces,
                        ];

                        $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpaceBeforeKeyword', $data);
                        if (true === $fix) {
                            $phpcsFile->fixer->replaceToken(($stackPtr - 1), '');
                        }
                    }
                }
            }//end if
        }//end if
    }

    //end processOpen()

    /**
     * Processes the closing section of a class declaration.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     */
    public function processClose(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        if (false === isset($tokens[$stackPtr]['scope_closer'])) {
            return;
        }

        $closeBrace = $tokens[$stackPtr]['scope_closer'];

        // Check that the closing brace has one blank line after it.
        for ($nextContent = ($closeBrace + 1); $nextContent < $phpcsFile->numTokens; ++$nextContent) {
            // Ignore comments on the same line as the brace.
            if ($tokens[$nextContent]['line'] === $tokens[$closeBrace]['line']
                && (T_WHITESPACE === $tokens[$nextContent]['code']
                || T_COMMENT === $tokens[$nextContent]['code']
                || true === isset(Tokens::$phpcsCommentTokens[$tokens[$nextContent]['code']]))
            ) {
                continue;
            }

            if (T_WHITESPACE !== $tokens[$nextContent]['code']) {
                break;
            }
        }

        if ($nextContent === $phpcsFile->numTokens) {
            // Ignore the line check as this is the very end of the file.
            $difference = 1;
        } else {
            $difference = ($tokens[$nextContent]['line'] - $tokens[$closeBrace]['line'] - 1);
        }

        $lastContent = $phpcsFile->findPrevious(T_WHITESPACE, ($closeBrace - 1), $stackPtr, true);

        if (-1 === $difference
            || $tokens[$lastContent]['line'] === $tokens[$closeBrace]['line']
        ) {
            $error = 'Closing %s brace must be on a line by itself';
            $data = [$tokens[$stackPtr]['content']];
            $fix = $phpcsFile->addFixableError($error, $closeBrace, 'CloseBraceSameLine', $data);
            if (true === $fix) {
                if (-1 === $difference) {
                    $phpcsFile->fixer->addNewlineBefore($nextContent);
                }

                if ($tokens[$lastContent]['line'] === $tokens[$closeBrace]['line']) {
                    $phpcsFile->fixer->addNewlineBefore($closeBrace);
                }
            }
        } elseif (T_WHITESPACE === $tokens[($closeBrace - 1)]['code']) {
            $prevContent = $tokens[($closeBrace - 1)]['content'];
            if ($prevContent !== $phpcsFile->eolChar) {
                $blankSpace = substr($prevContent, strpos($prevContent, $phpcsFile->eolChar));
                $spaces = \strlen($blankSpace);
                if (0 !== $spaces) {
                    if ($tokens[($closeBrace - 1)]['line'] !== $tokens[$closeBrace]['line']) {
                        $error = 'Expected 0 spaces before closing brace; newline found';
                        $phpcsFile->addError($error, $closeBrace, 'NewLineBeforeCloseBrace');
                    } else {
                        $error = 'Expected 0 spaces before closing brace; %s found';
                        $data = [$spaces];
                        $fix = $phpcsFile->addFixableError($error, $closeBrace, 'SpaceBeforeCloseBrace', $data);
                        if (true === $fix) {
                            $phpcsFile->fixer->replaceToken(($closeBrace - 1), '');
                        }
                    }
                }
            }
        }//end if

        if (-1 !== $difference && 1 !== $difference) {
            if (T_DOC_COMMENT_OPEN_TAG === $tokens[$nextContent]['code']) {
                $next = $phpcsFile->findNext(T_WHITESPACE, ($tokens[$nextContent]['comment_closer'] + 1), null, true);
                if (false !== $next && T_FUNCTION === $tokens[$next]['code']) {
                    return;
                }
            }

            $error = 'Closing brace of a %s must be followed by a single blank line; found %s';
            $data = [
                $tokens[$stackPtr]['content'],
                $difference,
            ];
            $fix = $phpcsFile->addFixableError($error, $closeBrace, 'NewlinesAfterCloseBrace', $data);
            if (true === $fix) {
                if (0 === $difference) {
                    $first = $phpcsFile->findFirstOnLine([], $nextContent, true);
                    $phpcsFile->fixer->addNewlineBefore($first);
                } else {
                    $phpcsFile->fixer->beginChangeset();
                    for ($i = ($closeBrace + 1); $i < $nextContent; ++$i) {
                        if ($tokens[$i]['line'] <= ($tokens[$closeBrace]['line'] + 1)) {
                            continue;
                        }
                        if ($tokens[$i]['line'] === $tokens[$nextContent]['line']) {
                            break;
                        }

                        $phpcsFile->fixer->replaceToken($i, '');
                    }

                    $phpcsFile->fixer->endChangeset();
                }
            }
        }//end if
    }

    //end processClose()
}//end class
