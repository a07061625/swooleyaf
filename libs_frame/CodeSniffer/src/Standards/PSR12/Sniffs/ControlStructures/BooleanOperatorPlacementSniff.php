<?php
/**
 * Checks that control structures have boolean operators in the correct place.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2019 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\PSR12\Sniffs\ControlStructures;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class BooleanOperatorPlacementSniff implements Sniff
{
    /**
     * Used to restrict the placement of the boolean operator.
     *
     * Allowed value are "first" or "last".
     *
     * @var null|string
     */
    public $allowOnly;

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
            T_SWITCH,
            T_ELSEIF,
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
            // Conditions are all on the same line.
            return;
        }

        $find = [
            T_BOOLEAN_AND,
            T_BOOLEAN_OR,
        ];

        if ('first' === $this->allowOnly || 'last' === $this->allowOnly) {
            $position = $this->allowOnly;
        } else {
            $position = null;
        }

        $operator = $parenOpener;
        $error = false;
        $operators = [];

        do {
            $operator = $phpcsFile->findNext($find, ($operator + 1), $parenCloser);
            if (false === $operator) {
                break;
            }

            $prev = $phpcsFile->findPrevious(T_WHITESPACE, ($operator - 1), $parenOpener, true);
            if (false === $prev) {
                // Parse error.
                return;
            }

            $next = $phpcsFile->findNext(T_WHITESPACE, ($operator + 1), $parenCloser, true);
            if (false === $next) {
                // Parse error.
                return;
            }

            $firstOnLine = false;
            $lastOnLine = false;

            if ($tokens[$prev]['line'] < $tokens[$operator]['line']) {
                // The boolean operator is the first content on the line.
                $firstOnLine = true;
            }

            if ($tokens[$next]['line'] > $tokens[$operator]['line']) {
                // The boolean operator is the last content on the line.
                $lastOnLine = true;
            }

            if (true === $firstOnLine && true === $lastOnLine) {
                // The operator is the only content on the line.
                // Don't record it because we can't determine
                // placement information from looking at it.
                continue;
            }

            $operators[] = $operator;

            if (false === $firstOnLine && false === $lastOnLine) {
                // It's in the middle of content, so we can't determine
                // placement information from looking at it, but we may
                // still need to process it.
                continue;
            }

            if (true === $firstOnLine) {
                if (null === $position) {
                    $position = 'first';
                }

                if ('first' !== $position) {
                    $error = true;
                }
            } else {
                if (null === $position) {
                    $position = 'last';
                }

                if ('last' !== $position) {
                    $error = true;
                }
            }
        } while (false !== $operator);

        if (false === $error) {
            return;
        }

        switch ($this->allowOnly) {
        case 'first':
            $error = 'Boolean operators between conditions must be at the beginning of the line';

            break;
        case 'last':
            $error = 'Boolean operators between conditions must be at the end of the line';

            break;
        default:
            $error = 'Boolean operators between conditions must be at the beginning or end of the line, but not both';
        }

        $fix = $phpcsFile->addFixableError($error, $stackPtr, 'FoundMixed');
        if (false === $fix) {
            return;
        }

        $phpcsFile->fixer->beginChangeset();
        foreach ($operators as $operator) {
            $prev = $phpcsFile->findPrevious(T_WHITESPACE, ($operator - 1), $parenOpener, true);
            $next = $phpcsFile->findNext(T_WHITESPACE, ($operator + 1), $parenCloser, true);

            if ('last' === $position) {
                if ($tokens[$next]['line'] === $tokens[$operator]['line']) {
                    if ($tokens[$prev]['line'] === $tokens[$operator]['line']) {
                        // Move the content after the operator to the next line.
                        if (T_WHITESPACE === $tokens[($operator + 1)]['code']) {
                            $phpcsFile->fixer->replaceToken(($operator + 1), '');
                        }

                        $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $operator, true);
                        $padding = str_repeat(' ', ($tokens[$first]['column'] - 1));
                        $phpcsFile->fixer->addContent($operator, $phpcsFile->eolChar . $padding);
                    } else {
                        // Move the operator to the end of the previous line.
                        if (T_WHITESPACE === $tokens[($operator + 1)]['code']) {
                            $phpcsFile->fixer->replaceToken(($operator + 1), '');
                        }

                        $phpcsFile->fixer->addContent($prev, ' ' . $tokens[$operator]['content']);
                        $phpcsFile->fixer->replaceToken($operator, '');
                    }
                }//end if
            } else {
                if ($tokens[$prev]['line'] === $tokens[$operator]['line']) {
                    if ($tokens[$next]['line'] === $tokens[$operator]['line']) {
                        // Move the operator, and the rest of the expression, to the next line.
                        if (T_WHITESPACE === $tokens[($operator - 1)]['code']) {
                            $phpcsFile->fixer->replaceToken(($operator - 1), '');
                        }

                        $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $operator, true);
                        $padding = str_repeat(' ', ($tokens[$first]['column'] - 1));
                        $phpcsFile->fixer->addContentBefore($operator, $phpcsFile->eolChar . $padding);
                    } else {
                        // Move the operator to the start of the next line.
                        if (T_WHITESPACE === $tokens[($operator - 1)]['code']) {
                            $phpcsFile->fixer->replaceToken(($operator - 1), '');
                        }

                        $phpcsFile->fixer->addContentBefore($next, $tokens[$operator]['content'] . ' ');
                        $phpcsFile->fixer->replaceToken($operator, '');
                    }
                }//end if
            }//end if
        }//end foreach

        $phpcsFile->fixer->endChangeset();
    }

    //end process()
}//end class
