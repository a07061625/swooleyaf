<?php
/**
 * Checks that two strings are not concatenated together; suggests using one string instead.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\Strings;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class UnnecessaryStringConcatSniff implements Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = [
        'PHP',
        'JS',
    ];

    /**
     * If true, an error will be thrown; otherwise a warning.
     *
     * @var bool
     */
    public $error = true;

    /**
     * If true, strings concatenated over multiple lines are allowed.
     *
     * Useful if you break strings over multiple lines to work
     * within a max line length.
     *
     * @var bool
     */
    public $allowMultiline = false;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_STRING_CONCAT,
            T_PLUS,
        ];
    }

    //end register()

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        // Work out which type of file this is for.
        $tokens = $phpcsFile->getTokens();
        if (T_STRING_CONCAT === $tokens[$stackPtr]['code']) {
            if ('JS' === $phpcsFile->tokenizerType) {
                return;
            }
        } else {
            if ('PHP' === $phpcsFile->tokenizerType) {
                return;
            }
        }

        $prev = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);
        $next = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
        if (false === $prev || false === $next) {
            return;
        }

        if (true === isset(Tokens::$stringTokens[$tokens[$prev]['code']])
            && true === isset(Tokens::$stringTokens[$tokens[$next]['code']])
        ) {
            if ($tokens[$prev]['content'][0] === $tokens[$next]['content'][0]) {
                // Before we throw an error for PHP, allow strings to be
                // combined if they would have < and ? next to each other because
                // this trick is sometimes required in PHP strings.
                if ('PHP' === $phpcsFile->tokenizerType) {
                    $prevChar = substr($tokens[$prev]['content'], -2, 1);
                    $nextChar = $tokens[$next]['content'][1];
                    $combined = $prevChar . $nextChar;
                    if ($combined === '?' . '>' || $combined === '<' . '?') {
                        return;
                    }
                }

                if (true === $this->allowMultiline
                    && $tokens[$prev]['line'] !== $tokens[$next]['line']
                ) {
                    return;
                }

                $error = 'String concat is not required here; use a single string instead';
                if (true === $this->error) {
                    $phpcsFile->addError($error, $stackPtr, 'Found');
                } else {
                    $phpcsFile->addWarning($error, $stackPtr, 'Found');
                }
            }//end if
        }//end if
    }

    //end process()
}//end class
