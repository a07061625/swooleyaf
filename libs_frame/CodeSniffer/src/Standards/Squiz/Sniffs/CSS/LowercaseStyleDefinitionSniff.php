<?php
/**
 * Ensure that all style definitions are in lowercase.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\CSS;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class LowercaseStyleDefinitionSniff implements Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = ['CSS'];

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return int[]
     */
    public function register()
    {
        return [T_OPEN_CURLY_BRACKET];
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
        $start = ($stackPtr + 1);
        $end = ($tokens[$stackPtr]['bracket_closer'] - 1);
        $inStyle = null;

        for ($i = $start; $i <= $end; ++$i) {
            // Skip nested definitions as they are checked individually.
            if (T_OPEN_CURLY_BRACKET === $tokens[$i]['code']) {
                $i = $tokens[$i]['bracket_closer'];

                continue;
            }

            if (T_STYLE === $tokens[$i]['code']) {
                $inStyle = $tokens[$i]['content'];
            }

            if (T_SEMICOLON === $tokens[$i]['code']) {
                $inStyle = null;
            }

            if ('progid' === $inStyle) {
                // Special case for IE filters.
                continue;
            }

            if (T_STYLE === $tokens[$i]['code']
                || (null !== $inStyle
                && T_STRING === $tokens[$i]['code'])
            ) {
                $expected = strtolower($tokens[$i]['content']);
                if ($expected !== $tokens[$i]['content']) {
                    $error = 'Style definitions must be lowercase; expected %s but found %s';
                    $data = [
                        $expected,
                        $tokens[$i]['content'],
                    ];

                    $fix = $phpcsFile->addFixableError($error, $i, 'FoundUpper', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken($i, $expected);
                    }
                }
            }
        }//end for
    }

    //end process()
}//end class
