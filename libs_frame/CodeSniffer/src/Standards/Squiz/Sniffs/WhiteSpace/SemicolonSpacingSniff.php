<?php
/**
 * Ensure there is no whitespace before a semicolon.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class SemicolonSpacingSniff implements Sniff
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
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_SEMICOLON];
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

        $prevType = $tokens[($stackPtr - 1)]['code'];
        if (false === isset(Tokens::$emptyTokens[$prevType])) {
            return;
        }

        $nonSpace = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 2), null, true);

        // Detect whether this is a semi-colon for a condition in a `for()` control structure.
        $forCondition = false;
        if (true === isset($tokens[$stackPtr]['nested_parenthesis'])) {
            $nestedParens = $tokens[$stackPtr]['nested_parenthesis'];
            $closeParenthesis = end($nestedParens);

            if (true === isset($tokens[$closeParenthesis]['parenthesis_owner'])) {
                $owner = $tokens[$closeParenthesis]['parenthesis_owner'];

                if (T_FOR === $tokens[$owner]['code']) {
                    $forCondition = true;
                    $nonSpace = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 2), null, true);
                }
            }
        }

        if (T_SEMICOLON === $tokens[$nonSpace]['code']
            || (true === $forCondition && $nonSpace === $tokens[$owner]['parenthesis_opener'])
            || (true === isset($tokens[$nonSpace]['scope_opener'])
            && $tokens[$nonSpace]['scope_opener'] === $nonSpace)
        ) {
            // Empty statement.
            return;
        }

        $expected = $tokens[$nonSpace]['content'] . ';';
        $found = $phpcsFile->getTokensAsString($nonSpace, ($stackPtr - $nonSpace)) . ';';
        $found = str_replace("\n", '\n', $found);
        $found = str_replace("\r", '\r', $found);
        $found = str_replace("\t", '\t', $found);
        $error = 'Space found before semicolon; expected "%s" but found "%s"';
        $data = [
            $expected,
            $found,
        ];

        $fix = $phpcsFile->addFixableError($error, $stackPtr, 'Incorrect', $data);
        if (true === $fix) {
            $phpcsFile->fixer->beginChangeset();
            $i = ($stackPtr - 1);
            while ((T_WHITESPACE === $tokens[$i]['code']) && ($i > $nonSpace)) {
                $phpcsFile->fixer->replaceToken($i, '');
                --$i;
            }

            $phpcsFile->fixer->addContent($nonSpace, ';');
            $phpcsFile->fixer->replaceToken($stackPtr, '');

            $phpcsFile->fixer->endChangeset();
        }
    }

    //end process()
}//end class
