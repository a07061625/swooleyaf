<?php
/**
 * Verifies that operators have valid spacing surrounding them.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\PSR12\Sniffs\Operators;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\OperatorSpacingSniff as SquizOperatorSpacingSniff;
use PHP_CodeSniffer\Util\Tokens;

class OperatorSpacingSniff extends SquizOperatorSpacingSniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        parent::register();

        $targets = Tokens::$comparisonTokens;
        $targets += Tokens::$operators;
        $targets += Tokens::$assignmentTokens;
        $targets += Tokens::$booleanOperators;
        $targets[] = T_INLINE_THEN;
        $targets[] = T_INLINE_ELSE;
        $targets[] = T_STRING_CONCAT;
        $targets[] = T_INSTANCEOF;

        return $targets;
    }

    //end register()

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The current file being checked.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (false === $this->isOperator($phpcsFile, $stackPtr)) {
            return;
        }

        $operator = $tokens[$stackPtr]['content'];

        $checkBefore = true;
        $checkAfter = true;

        // Skip short ternary.
        if (T_INLINE_ELSE === $tokens[($stackPtr)]['code']
            && T_INLINE_THEN === $tokens[($stackPtr - 1)]['code']
        ) {
            $checkBefore = false;
        }

        // Skip operator with comment on previous line.
        if (T_COMMENT === $tokens[($stackPtr - 1)]['code']
            && $tokens[($stackPtr - 1)]['line'] < $tokens[$stackPtr]['line']
        ) {
            $checkBefore = false;
        }

        if (true === isset($tokens[($stackPtr + 1)])) {
            // Skip short ternary.
            if (T_INLINE_THEN === $tokens[$stackPtr]['code']
                && T_INLINE_ELSE === $tokens[($stackPtr + 1)]['code']
            ) {
                $checkAfter = false;
            }
        } else {
            // Skip partial files.
            $checkAfter = false;
        }

        if (true === $checkBefore && T_WHITESPACE !== $tokens[($stackPtr - 1)]['code']) {
            $error = 'Expected at least 1 space before "%s"; 0 found';
            $data = [$operator];
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoSpaceBefore', $data);
            if (true === $fix) {
                $phpcsFile->fixer->addContentBefore($stackPtr, ' ');
            }
        }

        if (true === $checkAfter && T_WHITESPACE !== $tokens[($stackPtr + 1)]['code']) {
            $error = 'Expected at least 1 space after "%s"; 0 found';
            $data = [$operator];
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoSpaceAfter', $data);
            if (true === $fix) {
                $phpcsFile->fixer->addContent($stackPtr, ' ');
            }
        }
    }

    //end process()
}//end class
