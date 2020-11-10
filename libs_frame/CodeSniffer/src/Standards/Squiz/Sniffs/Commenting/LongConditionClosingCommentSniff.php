<?php
/**
 * Ensures long conditions have a comment at the end.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class LongConditionClosingCommentSniff implements Sniff
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
     * The length that a code block must be before
     * requiring a closing comment.
     *
     * @var int
     */
    public $lineLimit = 20;

    /**
     * The format the end comment should be in.
     *
     * The placeholder %s will be replaced with the type of condition opener.
     *
     * @var string
     */
    public $commentFormat = '//end %s';

    /**
     * The openers that we are interested in.
     *
     * @var int[]
     */
    private static $openers = [
        T_SWITCH,
        T_IF,
        T_FOR,
        T_FOREACH,
        T_WHILE,
        T_TRY,
        T_CASE,
    ];

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_CLOSE_CURLY_BRACKET];
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

        if (false === isset($tokens[$stackPtr]['scope_condition'])) {
            // No scope condition. It is a function closer.
            return;
        }

        $startCondition = $tokens[$tokens[$stackPtr]['scope_condition']];
        $startBrace = $tokens[$tokens[$stackPtr]['scope_opener']];
        $endBrace = $tokens[$stackPtr];

        // We are only interested in some code blocks.
        if (false === \in_array($startCondition['code'], self::$openers, true)) {
            return;
        }

        if (T_IF === $startCondition['code']) {
            // If this is actually an ELSE IF, skip it as the brace
            // will be checked by the original IF.
            $else = $phpcsFile->findPrevious(T_WHITESPACE, ($tokens[$stackPtr]['scope_condition'] - 1), null, true);
            if (T_ELSE === $tokens[$else]['code']) {
                return;
            }

            // IF statements that have an ELSE block need to use
            // "end if" rather than "end else" or "end elseif".
            do {
                $nextToken = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
                if (T_ELSE === $tokens[$nextToken]['code'] || T_ELSEIF === $tokens[$nextToken]['code']) {
                    // Check for ELSE IF (2 tokens) as opposed to ELSEIF (1 token).
                    if (T_ELSE === $tokens[$nextToken]['code']
                        && false === isset($tokens[$nextToken]['scope_closer'])
                    ) {
                        $nextToken = $phpcsFile->findNext(T_WHITESPACE, ($nextToken + 1), null, true);
                        if (T_IF !== $tokens[$nextToken]['code']
                            || false === isset($tokens[$nextToken]['scope_closer'])
                        ) {
                            // Not an ELSE IF or is an inline ELSE IF.
                            break;
                        }
                    }

                    if (false === isset($tokens[$nextToken]['scope_closer'])) {
                        // There isn't going to be anywhere to print the "end if" comment
                        // because there is no closer.
                        return;
                    }

                    // The end brace becomes the ELSE's end brace.
                    $stackPtr = $tokens[$nextToken]['scope_closer'];
                    $endBrace = $tokens[$stackPtr];
                } else {
                    break;
                }//end if
            } while (true === isset($tokens[$nextToken]['scope_closer']));
        }//end if

        if (T_TRY === $startCondition['code']) {
            // TRY statements need to check until the end of all CATCH statements.
            do {
                $nextToken = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
                if (T_CATCH === $tokens[$nextToken]['code']
                    || T_FINALLY === $tokens[$nextToken]['code']
                ) {
                    // The end brace becomes the CATCH end brace.
                    $stackPtr = $tokens[$nextToken]['scope_closer'];
                    $endBrace = $tokens[$stackPtr];
                } else {
                    break;
                }
            } while (true === isset($tokens[$nextToken]['scope_closer']));
        }

        $lineDifference = ($endBrace['line'] - $startBrace['line']);

        $expected = sprintf($this->commentFormat, $startCondition['content']);
        $comment = $phpcsFile->findNext([T_COMMENT], $stackPtr, null, false);

        if ((false === $comment) || ($tokens[$comment]['line'] !== $endBrace['line'])) {
            if ($lineDifference >= $this->lineLimit) {
                $error = 'End comment for long condition not found; expected "%s"';
                $data = [$expected];
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'Missing', $data);

                if (true === $fix) {
                    $next = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
                    if (false !== $next && $tokens[$next]['line'] === $tokens[$stackPtr]['line']) {
                        $expected .= $phpcsFile->eolChar;
                    }

                    $phpcsFile->fixer->addContent($stackPtr, $expected);
                }
            }

            return;
        }

        if (($comment - $stackPtr) !== 1) {
            $error = 'Space found before closing comment; expected "%s"';
            $data = [$expected];
            $phpcsFile->addError($error, $stackPtr, 'SpacingBefore', $data);
        }

        if (trim($tokens[$comment]['content']) !== $expected) {
            $found = trim($tokens[$comment]['content']);
            $error = 'Incorrect closing comment; expected "%s" but found "%s"';
            $data = [
                $expected,
                $found,
            ];

            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'Invalid', $data);
            if (true === $fix) {
                $phpcsFile->fixer->replaceToken($comment, $expected . $phpcsFile->eolChar);
            }

            return;
        }
    }

    //end process()
}//end class
