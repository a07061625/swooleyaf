<?php
/**
 * Checks the naming of variables and member variables.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Zend\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\AbstractVariableSniff;
use PHP_CodeSniffer\Util\Common;
use PHP_CodeSniffer\Util\Tokens;

class ValidVariableNameSniff extends AbstractVariableSniff
{
    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in the
     *                                               stack passed in $tokens.
     */
    protected function processVariable(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $varName = ltrim($tokens[$stackPtr]['content'], '$');

        // If it's a php reserved var, then its ok.
        if (true === isset($this->phpReservedVars[$varName])) {
            return;
        }

        $objOperator = $phpcsFile->findNext([T_WHITESPACE], ($stackPtr + 1), null, true);
        if (T_OBJECT_OPERATOR === $tokens[$objOperator]['code']
            || T_NULLSAFE_OBJECT_OPERATOR === $tokens[$objOperator]['code']
        ) {
            // Check to see if we are using a variable from an object.
            $var = $phpcsFile->findNext([T_WHITESPACE], ($objOperator + 1), null, true);
            if (T_STRING === $tokens[$var]['code']) {
                // Either a var name or a function call, so check for bracket.
                $bracket = $phpcsFile->findNext([T_WHITESPACE], ($var + 1), null, true);

                if (T_OPEN_PARENTHESIS !== $tokens[$bracket]['code']) {
                    $objVarName = $tokens[$var]['content'];

                    // There is no way for us to know if the var is public or private,
                    // so we have to ignore a leading underscore if there is one and just
                    // check the main part of the variable name.
                    $originalVarName = $objVarName;
                    if ('_' === substr($objVarName, 0, 1)) {
                        $objVarName = substr($objVarName, 1);
                    }

                    if (false === Common::isCamelCaps($objVarName, false, true, false)) {
                        $error = 'Variable "%s" is not in valid camel caps format';
                        $data = [$originalVarName];
                        $phpcsFile->addError($error, $var, 'NotCamelCaps', $data);
                    } elseif (1 === preg_match('|\d|', $objVarName)) {
                        $warning = 'Variable "%s" contains numbers but this is discouraged';
                        $data = [$originalVarName];
                        $phpcsFile->addWarning($warning, $stackPtr, 'ContainsNumbers', $data);
                    }
                }//end if
            }//end if
        }//end if

        // There is no way for us to know if the var is public or private,
        // so we have to ignore a leading underscore if there is one and just
        // check the main part of the variable name.
        $originalVarName = $varName;
        if ('_' === substr($varName, 0, 1)) {
            $objOperator = $phpcsFile->findPrevious([T_WHITESPACE], ($stackPtr - 1), null, true);
            if (T_DOUBLE_COLON === $tokens[$objOperator]['code']) {
                // The variable lives within a class, and is referenced like
                // this: MyClass::$_variable, so we don't know its scope.
                $inClass = true;
            } else {
                $inClass = $phpcsFile->hasCondition($stackPtr, Tokens::$ooScopeTokens);
            }

            if (true === $inClass) {
                $varName = substr($varName, 1);
            }
        }

        if (false === Common::isCamelCaps($varName, false, true, false)) {
            $error = 'Variable "%s" is not in valid camel caps format';
            $data = [$originalVarName];
            $phpcsFile->addError($error, $stackPtr, 'NotCamelCaps', $data);
        } elseif (1 === preg_match('|\d|', $varName)) {
            $warning = 'Variable "%s" contains numbers but this is discouraged';
            $data = [$originalVarName];
            $phpcsFile->addWarning($warning, $stackPtr, 'ContainsNumbers', $data);
        }
    }

    //end processVariable()

    /**
     * Processes class member variables.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in the
     *                                               stack passed in $tokens.
     */
    protected function processMemberVar(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $varName = ltrim($tokens[$stackPtr]['content'], '$');
        $memberProps = $phpcsFile->getMemberProperties($stackPtr);
        if (true === empty($memberProps)) {
            // Exception encountered.
            return;
        }

        $public = ('public' === $memberProps['scope']);

        if (true === $public) {
            if ('_' === substr($varName, 0, 1)) {
                $error = 'Public member variable "%s" must not contain a leading underscore';
                $data = [$varName];
                $phpcsFile->addError($error, $stackPtr, 'PublicHasUnderscore', $data);
            }
        } else {
            if ('_' !== substr($varName, 0, 1)) {
                $scope = ucfirst($memberProps['scope']);
                $error = '%s member variable "%s" must contain a leading underscore';
                $data = [
                    $scope,
                    $varName,
                ];
                $phpcsFile->addError($error, $stackPtr, 'PrivateNoUnderscore', $data);
            }
        }

        // Remove a potential underscore prefix for testing CamelCaps.
        $varName = ltrim($varName, '_');

        if (false === Common::isCamelCaps($varName, false, true, false)) {
            $error = 'Member variable "%s" is not in valid camel caps format';
            $data = [$varName];
            $phpcsFile->addError($error, $stackPtr, 'MemberVarNotCamelCaps', $data);
        } elseif (1 === preg_match('|\d|', $varName)) {
            $warning = 'Member variable "%s" contains numbers but this is discouraged';
            $data = [$varName];
            $phpcsFile->addWarning($warning, $stackPtr, 'MemberVarContainsNumbers', $data);
        }
    }

    //end processMemberVar()

    /**
     * Processes the variable found within a double quoted string.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the double quoted
     *                                               string.
     */
    protected function processVariableInString(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (0 !== preg_match_all('|[^\\\]\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)|', $tokens[$stackPtr]['content'], $matches)) {
            foreach ($matches[1] as $varName) {
                // If it's a php reserved var, then its ok.
                if (true === isset($this->phpReservedVars[$varName])) {
                    continue;
                }

                if (false === Common::isCamelCaps($varName, false, true, false)) {
                    $error = 'Variable "%s" is not in valid camel caps format';
                    $data = [$varName];
                    $phpcsFile->addError($error, $stackPtr, 'StringVarNotCamelCaps', $data);
                } elseif (1 === preg_match('|\d|', $varName)) {
                    $warning = 'Variable "%s" contains numbers but this is discouraged';
                    $data = [$varName];
                    $phpcsFile->addWarning($warning, $stackPtr, 'StringVarContainsNumbers', $data);
                }
            }//end foreach
        }//end if
    }

    //end processVariableInString()
}//end class
