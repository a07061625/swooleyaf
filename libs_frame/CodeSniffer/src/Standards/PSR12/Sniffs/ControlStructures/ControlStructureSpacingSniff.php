<?php
/**
 * Checks that control structures have the correct spacing.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2019 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\PSR12\Sniffs\ControlStructures;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\ControlStructures\ControlStructureSpacingSniff as PSR2Spacing;
use PHP_CodeSniffer\Util\Tokens;

class ControlStructureSpacingSniff implements Sniff
{
    /**
     * The number of spaces code should be indented.
     *
     * @var int
     */
    public $indent = 4;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_IF,
            T_WHILE,
            T_FOREACH,
            T_FOR,
            T_SWITCH,
            T_ELSE,
            T_ELSEIF,
            T_CATCH,
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

        if (false === isset($tokens[$stackPtr]['parenthesis_opener'])
            || false === isset($tokens[$stackPtr]['parenthesis_closer'])
        ) {
            return;
        }

        $parenOpener = $tokens[$stackPtr]['parenthesis_opener'];
        $parenCloser = $tokens[$stackPtr]['parenthesis_closer'];

        if ($tokens[$parenOpener]['line'] === $tokens[$parenCloser]['line']) {
            // Conditions are all on the same line, so follow PSR2.
            $sniff = new PSR2Spacing();

            return $sniff->process($phpcsFile, $stackPtr);
        }

        $next = $phpcsFile->findNext(T_WHITESPACE, ($parenOpener + 1), $parenCloser, true);
        if (false === $next) {
            // No conditions; parse error.
            return;
        }

        // Check the first expression.
        if ($tokens[$next]['line'] !== ($tokens[$parenOpener]['line'] + 1)) {
            $error = 'The first expression of a multi-line control structure must be on the line after the opening parenthesis';
            $fix = $phpcsFile->addFixableError($error, $next, 'FirstExpressionLine');
            if (true === $fix) {
                $phpcsFile->fixer->addNewline($parenOpener);
            }
        }

        // Check the indent of each line.
        $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $stackPtr, true);
        $requiredIndent = ($tokens[$first]['column'] + $this->indent - 1);
        for ($i = $parenOpener; $i < $parenCloser; ++$i) {
            if (1 !== $tokens[$i]['column']
                || $tokens[($i + 1)]['line'] > $tokens[$i]['line']
                || true === isset(Tokens::$commentTokens[$tokens[$i]['code']])
            ) {
                continue;
            }

            if (($i + 1) === $parenCloser) {
                break;
            }

            // Leave indentation inside multi-line strings.
            if (true === isset(Tokens::$textStringTokens[$tokens[$i]['code']])
                || true === isset(Tokens::$heredocTokens[$tokens[$i]['code']])
            ) {
                continue;
            }

            if (T_WHITESPACE !== $tokens[$i]['code']) {
                $foundIndent = 0;
            } else {
                $foundIndent = $tokens[$i]['length'];
            }

            if ($foundIndent < $requiredIndent) {
                $error = 'Each line in a multi-line control structure must be indented at least once; expected at least %s spaces, but found %s';
                $data = [
                    $requiredIndent,
                    $foundIndent,
                ];
                $fix = $phpcsFile->addFixableError($error, $i, 'LineIndent', $data);
                if (true === $fix) {
                    $padding = str_repeat(' ', $requiredIndent);
                    if (0 === $foundIndent) {
                        $phpcsFile->fixer->addContentBefore($i, $padding);
                    } else {
                        $phpcsFile->fixer->replaceToken($i, $padding);
                    }
                }
            }
        }//end for

        // Check the closing parenthesis.
        $prev = $phpcsFile->findPrevious(T_WHITESPACE, ($parenCloser - 1), $parenOpener, true);
        if ($tokens[$parenCloser]['line'] !== ($tokens[$prev]['line'] + 1)) {
            $error = 'The closing parenthesis of a multi-line control structure must be on the line after the last expression';
            $fix = $phpcsFile->addFixableError($error, $parenCloser, 'CloseParenthesisLine');
            if (true === $fix) {
                if ($tokens[$parenCloser]['line'] === $tokens[$prev]['line']) {
                    $phpcsFile->fixer->addNewlineBefore($parenCloser);
                } else {
                    $phpcsFile->fixer->beginChangeset();
                    for ($i = ($prev + 1); $i < $parenCloser; ++$i) {
                        // Maintain existing newline.
                        if ($tokens[$i]['line'] === $tokens[$prev]['line']) {
                            continue;
                        }

                        // Maintain existing indent.
                        if ($tokens[$i]['line'] === $tokens[$parenCloser]['line']) {
                            break;
                        }

                        $phpcsFile->fixer->replaceToken($i, '');
                    }

                    $phpcsFile->fixer->endChangeset();
                }
            }//end if
        }//end if

        if ($tokens[$parenCloser]['line'] !== $tokens[$prev]['line']) {
            $requiredIndent = ($tokens[$first]['column'] - 1);
            $foundIndent = ($tokens[$parenCloser]['column'] - 1);
            if ($foundIndent !== $requiredIndent) {
                $error = 'The closing parenthesis of a multi-line control structure must be indented to the same level as start of the control structure; expected %s spaces but found %s';
                $data = [
                    $requiredIndent,
                    $foundIndent,
                ];
                $fix = $phpcsFile->addFixableError($error, $parenCloser, 'CloseParenthesisIndent', $data);
                if (true === $fix) {
                    $padding = str_repeat(' ', $requiredIndent);
                    if (0 === $foundIndent) {
                        $phpcsFile->fixer->addContentBefore($parenCloser, $padding);
                    } else {
                        $phpcsFile->fixer->replaceToken(($parenCloser - 1), $padding);
                    }
                }
            }
        }
    }

    //end process()
}//end class
