<?php
/**
 * Makes sure there are no spaces around the concatenation operator.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\Strings;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class ConcatenationSpacingSniff implements Sniff
{
    /**
     * The number of spaces before and after a string concat.
     *
     * @var int
     */
    public $spacing = 0;

    /**
     * Allow newlines instead of spaces.
     *
     * @var bool
     */
    public $ignoreNewlines = false;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_STRING_CONCAT];
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
        if (false === isset($tokens[($stackPtr + 2)])) {
            // Syntax error or live coding, bow out.
            return;
        }

        $ignoreBefore = false;
        $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
        if (T_END_HEREDOC === $tokens[$prev]['code'] || T_END_NOWDOC === $tokens[$prev]['code']) {
            // Spacing before must be preserved due to the here/nowdoc closing tag.
            $ignoreBefore = true;
        }

        $this->spacing = (int)$this->spacing;

        if (false === $ignoreBefore) {
            if (T_WHITESPACE !== $tokens[($stackPtr - 1)]['code']) {
                $before = 0;
            } else {
                if ($tokens[($stackPtr - 2)]['line'] !== $tokens[$stackPtr]['line']) {
                    $before = 'newline';
                } else {
                    $before = $tokens[($stackPtr - 1)]['length'];
                }
            }

            $phpcsFile->recordMetric($stackPtr, 'Spacing before string concat', $before);
        }

        if (T_WHITESPACE !== $tokens[($stackPtr + 1)]['code']) {
            $after = 0;
        } else {
            if ($tokens[($stackPtr + 2)]['line'] !== $tokens[$stackPtr]['line']) {
                $after = 'newline';
            } else {
                $after = $tokens[($stackPtr + 1)]['length'];
            }
        }

        $phpcsFile->recordMetric($stackPtr, 'Spacing after string concat', $after);

        if ((true === $ignoreBefore
            || $before === $this->spacing
            || ('newline' === $before
            && true === $this->ignoreNewlines))
            && ($after === $this->spacing
            || ('newline' === $after
            && true === $this->ignoreNewlines))
        ) {
            return;
        }

        if (0 === $this->spacing) {
            $message = 'Concat operator must not be surrounded by spaces';
            $data = [];
        } else {
            if ($this->spacing > 1) {
                $message = 'Concat operator must be surrounded by %s spaces';
            } else {
                $message = 'Concat operator must be surrounded by a single space';
            }

            $data = [$this->spacing];
        }

        $fix = $phpcsFile->addFixableError($message, $stackPtr, 'PaddingFound', $data);

        if (true === $fix) {
            $padding = str_repeat(' ', $this->spacing);
            if (false === $ignoreBefore && ('newline' !== $before || false === $this->ignoreNewlines)) {
                if (T_WHITESPACE === $tokens[($stackPtr - 1)]['code']) {
                    $phpcsFile->fixer->beginChangeset();
                    $phpcsFile->fixer->replaceToken(($stackPtr - 1), $padding);
                    if (0 === $this->spacing
                        && (T_LNUMBER === $tokens[($stackPtr - 2)]['code']
                        || T_DNUMBER === $tokens[($stackPtr - 2)]['code'])
                    ) {
                        $phpcsFile->fixer->replaceToken(($stackPtr - 2), '(' . $tokens[($stackPtr - 2)]['content'] . ')');
                    }

                    $phpcsFile->fixer->endChangeset();
                } elseif ($this->spacing > 0) {
                    $phpcsFile->fixer->addContent(($stackPtr - 1), $padding);
                }
            }

            if ('newline' !== $after || false === $this->ignoreNewlines) {
                if (T_WHITESPACE === $tokens[($stackPtr + 1)]['code']) {
                    $phpcsFile->fixer->beginChangeset();
                    $phpcsFile->fixer->replaceToken(($stackPtr + 1), $padding);
                    if (0 === $this->spacing
                        && (T_LNUMBER === $tokens[($stackPtr + 2)]['code']
                        || T_DNUMBER === $tokens[($stackPtr + 2)]['code'])
                    ) {
                        $phpcsFile->fixer->replaceToken(($stackPtr + 2), '(' . $tokens[($stackPtr + 2)]['content'] . ')');
                    }

                    $phpcsFile->fixer->endChangeset();
                } elseif ($this->spacing > 0) {
                    $phpcsFile->fixer->addContent($stackPtr, $padding);
                }
            }
        }//end if
    }

    //end process()
}//end class
