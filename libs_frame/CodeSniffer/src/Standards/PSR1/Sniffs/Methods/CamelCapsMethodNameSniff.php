<?php
/**
 * Ensures method names are defined using camel case.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\PSR1\Sniffs\Methods;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\CamelCapsFunctionNameSniff as GenericCamelCapsFunctionNameSniff;
use PHP_CodeSniffer\Util\Common;

class CamelCapsMethodNameSniff extends GenericCamelCapsFunctionNameSniff
{
    /**
     * Processes the tokens within the scope.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being processed.
     * @param int                         $stackPtr  The position where this token was
     *                                               found.
     * @param int                         $currScope The position of the current scope.
     */
    protected function processTokenWithinScope(File $phpcsFile, $stackPtr, $currScope)
    {
        $tokens = $phpcsFile->getTokens();

        // Determine if this is a function which needs to be examined.
        $conditions = $tokens[$stackPtr]['conditions'];
        end($conditions);
        $deepestScope = key($conditions);
        if ($deepestScope !== $currScope) {
            return;
        }

        $methodName = $phpcsFile->getDeclarationName($stackPtr);
        if (null === $methodName) {
            // Ignore closures.
            return;
        }

        // Ignore magic methods.
        if (0 !== preg_match('|^__[^_]|', $methodName)) {
            $magicPart = strtolower(substr($methodName, 2));
            if (true === isset($this->magicMethods[$magicPart])
                || true === isset($this->methodsDoubleUnderscore[$magicPart])
            ) {
                return;
            }
        }

        $testName = ltrim($methodName, '_');
        if ('' !== $testName && false === Common::isCamelCaps($testName, false, true, false)) {
            $error = 'Method name "%s" is not in camel caps format';
            $className = $phpcsFile->getDeclarationName($currScope);
            if (false === isset($className)) {
                $className = '[Anonymous Class]';
            }

            $errorData = [$className . '::' . $methodName];
            $phpcsFile->addError($error, $stackPtr, 'NotCamelCaps', $errorData);
            $phpcsFile->recordMetric($stackPtr, 'CamelCase method name', 'no');
        } else {
            $phpcsFile->recordMetric($stackPtr, 'CamelCase method name', 'yes');
        }
    }

    //end processTokenWithinScope()

    /**
     * Processes the tokens outside the scope.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being processed.
     * @param int                         $stackPtr  The position where this token was
     *                                               found.
     */
    protected function processTokenOutsideScope(File $phpcsFile, $stackPtr)
    {
    }

    //end processTokenOutsideScope()
}//end class
