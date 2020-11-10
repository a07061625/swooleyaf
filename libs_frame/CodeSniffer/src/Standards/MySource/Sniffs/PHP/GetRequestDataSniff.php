<?php
/**
 * Ensures that getRequestData() is used to access super globals.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\MySource\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class GetRequestDataSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_VARIABLE];
    }

    //end register()

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $varName = $tokens[$stackPtr]['content'];
        if ('$_REQUEST' !== $varName
            && '$_GET' !== $varName
            && '$_POST' !== $varName
            && '$_FILES' !== $varName
        ) {
            return;
        }

        // The only place these super globals can be accessed directly is
        // in the getRequestData() method of the Security class.
        $inClass = false;
        foreach ($tokens[$stackPtr]['conditions'] as $i => $type) {
            if (T_CLASS === $tokens[$i]['code']) {
                $className = $phpcsFile->findNext(T_STRING, $i);
                $className = $tokens[$className]['content'];
                if ('security' === strtolower($className)) {
                    $inClass = true;
                } else {
                    // We don't have nested classes.
                    break;
                }
            } elseif (true === $inClass && T_FUNCTION === $tokens[$i]['code']) {
                $funcName = $phpcsFile->findNext(T_STRING, $i);
                $funcName = $tokens[$funcName]['content'];
                if ('getrequestdata' === strtolower($funcName)) {
                    // This is valid.
                    return;
                }
                // We don't have nested functions.
                break;
            }//end if
        }//end foreach

        // If we get to here, the super global was used incorrectly.
        // First find out how it is being used.
        $globalName = strtolower(substr($varName, 2));
        $usedVar = '';

        $openBracket = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
        if (T_OPEN_SQUARE_BRACKET === $tokens[$openBracket]['code']) {
            $closeBracket = $tokens[$openBracket]['bracket_closer'];
            $usedVar = $phpcsFile->getTokensAsString(($openBracket + 1), ($closeBracket - $openBracket - 1));
        }

        $type = 'SuperglobalAccessed';
        $error = 'The %s super global must not be accessed directly; use Security::getRequestData(';
        $data = [$varName];
        if ('' !== $usedVar) {
            $type .= 'WithVar';
            $error .= '%s, \'%s\'';
            $data[] = $usedVar;
            $data[] = $globalName;
        }

        $error .= ') instead';
        $phpcsFile->addError($error, $stackPtr, $type, $data);
    }

    //end process()
}//end class
