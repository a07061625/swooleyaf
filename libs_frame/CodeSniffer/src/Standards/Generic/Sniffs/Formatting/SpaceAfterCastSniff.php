<?php
/**
 * Ensures there is a single space after cast tokens.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class SpaceAfterCastSniff implements Sniff
{
    /**
     * The number of spaces desired after a cast token.
     *
     * @var int
     */
    public $spacing = 1;

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
        return Tokens::$castTokens;
    }

    //end register()

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $this->spacing = (int)$this->spacing;

        if (T_BINARY_CAST === $tokens[$stackPtr]['code']
            && 'b' === $tokens[$stackPtr]['content']
        ) {
            // You can't replace a space after this type of binary casting.
            return;
        }

        $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if (false === $nextNonEmpty) {
            return;
        }

        if (true === $this->ignoreNewlines
            && $tokens[$stackPtr]['line'] !== $tokens[$nextNonEmpty]['line']
        ) {
            $phpcsFile->recordMetric($stackPtr, 'Spacing after cast statement', 'newline');

            return;
        }

        if (0 === $this->spacing && $nextNonEmpty === ($stackPtr + 1)) {
            $phpcsFile->recordMetric($stackPtr, 'Spacing after cast statement', 0);

            return;
        }

        $nextNonWhitespace = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
        if ($nextNonEmpty !== $nextNonWhitespace) {
            $error = 'Expected %s space(s) after cast statement; comment found';
            $data = [$this->spacing];
            $phpcsFile->addError($error, $stackPtr, 'CommentFound', $data);

            if (T_WHITESPACE === $tokens[($stackPtr + 1)]['code']) {
                $phpcsFile->recordMetric($stackPtr, 'Spacing after cast statement', $tokens[($stackPtr + 1)]['length']);
            } else {
                $phpcsFile->recordMetric($stackPtr, 'Spacing after cast statement', 0);
            }

            return;
        }

        $found = 0;
        if ($tokens[$stackPtr]['line'] !== $tokens[$nextNonEmpty]['line']) {
            $found = 'newline';
        } elseif (T_WHITESPACE === $tokens[($stackPtr + 1)]['code']) {
            $found = $tokens[($stackPtr + 1)]['length'];
        }

        $phpcsFile->recordMetric($stackPtr, 'Spacing after cast statement', $found);

        if ($found === $this->spacing) {
            return;
        }

        $error = 'Expected %s space(s) after cast statement; %s found';
        $data = [
            $this->spacing,
            $found,
        ];

        $errorCode = 'TooMuchSpace';
        if (0 !== $this->spacing) {
            if (0 === $found) {
                $errorCode = 'NoSpace';
            } elseif ('newline' !== $found && $found < $this->spacing) {
                $errorCode = 'TooLittleSpace';
            }
        }

        $fix = $phpcsFile->addFixableError($error, $stackPtr, $errorCode, $data);

        if (true === $fix) {
            $padding = str_repeat(' ', $this->spacing);
            if (0 === $found) {
                $phpcsFile->fixer->addContent($stackPtr, $padding);
            } else {
                $phpcsFile->fixer->beginChangeset();
                $start = ($stackPtr + 1);

                if ($this->spacing > 0) {
                    $phpcsFile->fixer->replaceToken($start, $padding);
                    ++$start;
                }

                for ($i = $start; $i < $nextNonWhitespace; ++$i) {
                    $phpcsFile->fixer->replaceToken($i, '');
                }

                $phpcsFile->fixer->endChangeset();
            }
        }
    }

    //end process()
}//end class
