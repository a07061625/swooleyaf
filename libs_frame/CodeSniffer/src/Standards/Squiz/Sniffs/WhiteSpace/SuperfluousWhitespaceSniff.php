<?php
/**
 * Checks for unneeded whitespace.
 *
 * Checks that no whitespace precedes the first content of the file, exists
 * after the last content of the file, resides after content on any line, or
 * are two empty lines in functions.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class SuperfluousWhitespaceSniff implements Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = [
        'PHP',
        'JS',
        'CSS',
    ];

    /**
     * If TRUE, whitespace rules are not checked for blank lines.
     *
     * Blank lines are those that contain only whitespace.
     *
     * @var bool
     */
    public $ignoreBlankLines = false;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_OPEN_TAG,
            T_CLOSE_TAG,
            T_WHITESPACE,
            T_COMMENT,
            T_DOC_COMMENT_WHITESPACE,
            T_CLOSURE,
        ];
    }

    //end register()

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in the
     *                                               stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (T_OPEN_TAG === $tokens[$stackPtr]['code']) {
            // Check for start of file whitespace.

            if ('PHP' !== $phpcsFile->tokenizerType) {
                // The first token is always the open tag inserted when tokenized
                // and the second token is always the first piece of content in
                // the file. If the second token is whitespace, there was
                // whitespace at the start of the file.
                if (T_WHITESPACE !== $tokens[($stackPtr + 1)]['code']) {
                    return;
                }

                if (true === $phpcsFile->fixer->enabled) {
                    $stackPtr = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
                }
            } else {
                // If it's the first token, then there is no space.
                if (0 === $stackPtr) {
                    return;
                }

                $beforeOpen = '';

                for ($i = ($stackPtr - 1); $i >= 0; --$i) {
                    // If we find something that isn't inline html then there is something previous in the file.
                    if ('T_INLINE_HTML' !== $tokens[$i]['type']) {
                        return;
                    }

                    $beforeOpen .= $tokens[$i]['content'];
                }

                // If we have ended up with inline html make sure it isn't just whitespace.
                if (1 !== preg_match('`^[\pZ\s]+$`u', $beforeOpen)) {
                    return;
                }
            }//end if

            $fix = $phpcsFile->addFixableError('Additional whitespace found at start of file', $stackPtr, 'StartFile');
            if (true === $fix) {
                $phpcsFile->fixer->beginChangeset();
                for ($i = 0; $i < $stackPtr; ++$i) {
                    $phpcsFile->fixer->replaceToken($i, '');
                }

                $phpcsFile->fixer->endChangeset();
            }
        } elseif (T_CLOSE_TAG === $tokens[$stackPtr]['code']) {
            // Check for end of file whitespace.

            if ('PHP' === $phpcsFile->tokenizerType) {
                if (false === isset($tokens[($stackPtr + 1)])) {
                    // The close PHP token is the last in the file.
                    return;
                }

                $afterClose = '';

                for ($i = ($stackPtr + 1); $i < $phpcsFile->numTokens; ++$i) {
                    // If we find something that isn't inline HTML then there
                    // is more to the file.
                    if ('T_INLINE_HTML' !== $tokens[$i]['type']) {
                        return;
                    }

                    $afterClose .= $tokens[$i]['content'];
                }

                // If we have ended up with inline html make sure it isn't just whitespace.
                if (1 !== preg_match('`^[\pZ\s]+$`u', $afterClose)) {
                    return;
                }
            } else {
                // The last token is always the close tag inserted when tokenized
                // and the second last token is always the last piece of content in
                // the file. If the second last token is whitespace, there was
                // whitespace at the end of the file.
                --$stackPtr;

                // The pointer is now looking at the last content in the file and
                // not the fake PHP end tag the tokenizer inserted.
                if (T_WHITESPACE !== $tokens[$stackPtr]['code']) {
                    return;
                }

                // Allow a single newline at the end of the last line in the file.
                if (T_WHITESPACE !== $tokens[($stackPtr - 1)]['code']
                    && $tokens[$stackPtr]['content'] === $phpcsFile->eolChar
                ) {
                    return;
                }
            }//end if

            $fix = $phpcsFile->addFixableError('Additional whitespace found at end of file', $stackPtr, 'EndFile');
            if (true === $fix) {
                if ('PHP' !== $phpcsFile->tokenizerType) {
                    $prev = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);
                    $stackPtr = ($prev + 1);
                }

                $phpcsFile->fixer->beginChangeset();
                for ($i = ($stackPtr + 1); $i < $phpcsFile->numTokens; ++$i) {
                    $phpcsFile->fixer->replaceToken($i, '');
                }

                $phpcsFile->fixer->endChangeset();
            }
        } else {
            // Check for end of line whitespace.

            // Ignore whitespace that is not at the end of a line.
            if (true === isset($tokens[($stackPtr + 1)]['line'])
                && $tokens[($stackPtr + 1)]['line'] === $tokens[$stackPtr]['line']
            ) {
                return;
            }

            // Ignore blank lines if required.
            if (true === $this->ignoreBlankLines
                && T_WHITESPACE === $tokens[$stackPtr]['code']
                && $tokens[($stackPtr - 1)]['line'] !== $tokens[$stackPtr]['line']
            ) {
                return;
            }

            $tokenContent = rtrim($tokens[$stackPtr]['content'], $phpcsFile->eolChar);
            if (false === empty($tokenContent)) {
                if ($tokenContent !== rtrim($tokenContent)) {
                    $fix = $phpcsFile->addFixableError('Whitespace found at end of line', $stackPtr, 'EndLine');
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken($stackPtr, rtrim($tokenContent) . $phpcsFile->eolChar);
                    }
                }
            } elseif ($tokens[($stackPtr - 1)]['content'] !== rtrim($tokens[($stackPtr - 1)]['content'])
                && $tokens[($stackPtr - 1)]['line'] === $tokens[$stackPtr]['line']
            ) {
                $fix = $phpcsFile->addFixableError('Whitespace found at end of line', ($stackPtr - 1), 'EndLine');
                if (true === $fix) {
                    $phpcsFile->fixer->replaceToken(($stackPtr - 1), rtrim($tokens[($stackPtr - 1)]['content']));
                }
            }

            // Check for multiple blank lines in a function.

            if ((true === $phpcsFile->hasCondition($stackPtr, [T_FUNCTION, T_CLOSURE]))
                && $tokens[($stackPtr - 1)]['line'] < $tokens[$stackPtr]['line']
                && $tokens[($stackPtr - 2)]['line'] === $tokens[($stackPtr - 1)]['line']
            ) {
                // Properties and functions in nested classes have their own rules for spacing.
                $conditions = $tokens[$stackPtr]['conditions'];
                $deepestScope = end($conditions);
                if (T_ANON_CLASS === $deepestScope) {
                    return;
                }

                // This is an empty line and the line before this one is not
                // empty, so this could be the start of a multiple empty
                // line block.
                $next = $phpcsFile->findNext(T_WHITESPACE, $stackPtr, null, true);
                $lines = ($tokens[$next]['line'] - $tokens[$stackPtr]['line']);
                if ($lines > 1) {
                    $error = 'Functions must not contain multiple empty lines in a row; found %s empty lines';
                    $fix = $phpcsFile->addFixableError($error, $stackPtr, 'EmptyLines', [$lines]);
                    if (true === $fix) {
                        $phpcsFile->fixer->beginChangeset();
                        $i = $stackPtr;
                        while ($tokens[$i]['line'] !== $tokens[$next]['line']) {
                            $phpcsFile->fixer->replaceToken($i, '');
                            ++$i;
                        }

                        $phpcsFile->fixer->addNewlineBefore($i);
                        $phpcsFile->fixer->endChangeset();
                    }
                }
            }//end if
        }//end if
    }

    //end process()
}//end class
