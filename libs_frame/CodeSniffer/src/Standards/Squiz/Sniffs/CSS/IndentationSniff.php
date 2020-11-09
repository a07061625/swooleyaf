<?php
/**
 * Ensures styles are indented 4 spaces.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\CSS;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class IndentationSniff implements Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = ['CSS'];

    /**
     * The number of spaces code should be indented.
     *
     * @var int
     */
    public $indent = 4;

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return int[]
     */
    public function register()
    {
        return [T_OPEN_TAG];
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

        $numTokens = (\count($tokens) - 2);
        $indentLevel = 0;
        $nestingLevel = 0;
        for ($i = 1; $i < $numTokens; ++$i) {
            if (T_COMMENT === $tokens[$i]['code']
                || true === isset(Tokens::$phpcsCommentTokens[$tokens[$i]['code']])
            ) {
                // Don't check the indent of comments.
                continue;
            }

            if (T_OPEN_CURLY_BRACKET === $tokens[$i]['code']) {
                ++$indentLevel;

                if (false === isset($tokens[$i]['bracket_closer'])) {
                    // Syntax error or live coding.
                    // Anything after this would receive incorrect fixes, so bow out.
                    return;
                }

                // Check for nested class definitions.
                $found = $phpcsFile->findNext(
                    T_OPEN_CURLY_BRACKET,
                    ($i + 1),
                    $tokens[$i]['bracket_closer']
                );

                if (false !== $found) {
                    $nestingLevel = $indentLevel;
                }
            }

            if ((T_CLOSE_CURLY_BRACKET === $tokens[$i]['code']
                && $tokens[$i]['line'] !== $tokens[($i - 1)]['line'])
                || (T_CLOSE_CURLY_BRACKET === $tokens[($i + 1)]['code']
                && $tokens[$i]['line'] === $tokens[($i + 1)]['line'])
            ) {
                --$indentLevel;
                if (0 === $indentLevel) {
                    $nestingLevel = 0;
                }
            }

            if (1 !== $tokens[$i]['column']
                || T_OPEN_CURLY_BRACKET === $tokens[$i]['code']
                || T_CLOSE_CURLY_BRACKET === $tokens[$i]['code']
            ) {
                continue;
            }

            // We started a new line, so check indent.
            if (T_WHITESPACE === $tokens[$i]['code']) {
                $content = str_replace($phpcsFile->eolChar, '', $tokens[$i]['content']);
                $foundIndent = \strlen($content);
            } else {
                $foundIndent = 0;
            }

            $expectedIndent = ($indentLevel * $this->indent);
            if ($expectedIndent > 0
                && false !== strpos($tokens[$i]['content'], $phpcsFile->eolChar)
            ) {
                if ($nestingLevel !== $indentLevel) {
                    $error = 'Blank lines are not allowed in class definitions';
                    $fix = $phpcsFile->addFixableError($error, $i, 'BlankLine');
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken($i, '');
                    }
                }
            } elseif ($foundIndent !== $expectedIndent) {
                $error = 'Line indented incorrectly; expected %s spaces, found %s';
                $data = [
                    $expectedIndent,
                    $foundIndent,
                ];

                $fix = $phpcsFile->addFixableError($error, $i, 'Incorrect', $data);
                if (true === $fix) {
                    $indent = str_repeat(' ', $expectedIndent);
                    if (0 === $foundIndent) {
                        $phpcsFile->fixer->addContentBefore($i, $indent);
                    } else {
                        $phpcsFile->fixer->replaceToken($i, $indent);
                    }
                }
            }//end if
        }//end for
    }

    //end process()
}//end class
