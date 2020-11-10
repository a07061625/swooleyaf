<?php
/**
 * Ensures that systems, asset types and libs are included before they are used.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\MySource\Sniffs\Channels;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\AbstractScopeSniff;
use PHP_CodeSniffer\Util\Tokens;

class IncludeSystemSniff extends AbstractScopeSniff
{
    /**
     * A list of classes that don't need to be included.
     *
     * @var string[]
     */
    private $ignore = [
        'self' => true,
        'static' => true,
        'parent' => true,
        'channels' => true,
        'basesystem' => true,
        'dal' => true,
        'init' => true,
        'pdo' => true,
        'util' => true,
        'ziparchive' => true,
        'phpunit_framework_assert' => true,
        'abstractmysourceunittest' => true,
        'abstractdatacleanunittest' => true,
        'exception' => true,
        'abstractwidgetwidgettype' => true,
        'domdocument' => true,
    ];

    /**
     * Constructs an AbstractScopeSniff.
     */
    public function __construct()
    {
        parent::__construct([T_FUNCTION], [T_DOUBLE_COLON, T_EXTENDS], true);
    }

    //end __construct()

    /**
     * Processes the function tokens within the class.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file where this token was found.
     * @param int                         $stackPtr  The position where the token was found.
     * @param int                         $currScope The current scope opener token.
     */
    protected function processTokenWithinScope(File $phpcsFile, $stackPtr, $currScope)
    {
        $tokens = $phpcsFile->getTokens();

        // Determine the name of the class that the static function
        // is being called on.
        $classNameToken = $phpcsFile->findPrevious(
            T_WHITESPACE,
            ($stackPtr - 1),
            null,
            true
        );

        // Don't process class names represented by variables as this can be
        // an inexact science.
        if (T_VARIABLE === $tokens[$classNameToken]['code']) {
            return;
        }

        $className = $tokens[$classNameToken]['content'];
        if (true === isset($this->ignore[strtolower($className)])) {
            return;
        }

        $includedClasses = [];

        $fileName = strtolower($phpcsFile->getFilename());
        $matches = [];
        if (0 !== preg_match('|/systems/(.*)/([^/]+)?actions.inc$|', $fileName, $matches)) {
            // This is an actions file, which means we don't
            // have to include the system in which it exists.
            $includedClasses[$matches[2]] = true;

            // Or a system it implements.
            $class = $phpcsFile->getCondition($stackPtr, T_CLASS);
            $implements = $phpcsFile->findNext(T_IMPLEMENTS, $class, ($class + 10));
            if (false !== $implements) {
                $implementsClass = $phpcsFile->findNext(T_STRING, $implements);
                $implementsClassName = strtolower($tokens[$implementsClass]['content']);
                if ('actions' === substr($implementsClassName, -7)) {
                    $includedClasses[substr($implementsClassName, 0, -7)] = true;
                }
            }
        }

        // Go searching for includeSystem and includeAsset calls within this
        // function, or the inclusion of .inc files, which
        // would be library files.
        for ($i = ($currScope + 1); $i < $stackPtr; ++$i) {
            $name = $this->getIncludedClassFromToken($phpcsFile, $tokens, $i);
            if (false !== $name) {
                $includedClasses[$name] = true;
            // Special case for Widgets cause they are, well, special.
            } elseif ('includewidget' === strtolower($tokens[$i]['content'])) {
                $typeName = $phpcsFile->findNext(T_CONSTANT_ENCAPSED_STRING, ($i + 1));
                $typeName = trim($tokens[$typeName]['content'], " '");
                $includedClasses[strtolower($typeName) . 'widgettype'] = true;
            }
        }

        // Now go searching for includeSystem, includeAsset or require/include
        // calls outside our scope. If we are in a class, look outside the
        // class. If we are not, look outside the function.
        $condPtr = $currScope;
        if (true === $phpcsFile->hasCondition($stackPtr, T_CLASS)) {
            foreach ($tokens[$stackPtr]['conditions'] as $condPtr => $condType) {
                if (T_CLASS === $condType) {
                    break;
                }
            }
        }

        for ($i = 0; $i < $condPtr; ++$i) {
            // Skip other scopes.
            if (true === isset($tokens[$i]['scope_closer'])) {
                $i = $tokens[$i]['scope_closer'];

                continue;
            }

            $name = $this->getIncludedClassFromToken($phpcsFile, $tokens, $i);
            if (false !== $name) {
                $includedClasses[$name] = true;
            }
        }

        // If we are in a testing class, we might have also included
        // some systems and classes in our setUp() method.
        $setupFunction = null;
        if (true === $phpcsFile->hasCondition($stackPtr, T_CLASS)) {
            foreach ($tokens[$stackPtr]['conditions'] as $condPtr => $condType) {
                if (T_CLASS === $condType) {
                    // Is this is a testing class?
                    $name = $phpcsFile->findNext(T_STRING, $condPtr);
                    $name = $tokens[$name]['content'];
                    if ('UnitTest' === substr($name, -8)) {
                        // Look for a method called setUp().
                        $end = $tokens[$condPtr]['scope_closer'];
                        $function = $phpcsFile->findNext(T_FUNCTION, ($condPtr + 1), $end);
                        while (false !== $function) {
                            $name = $phpcsFile->findNext(T_STRING, $function);
                            if ('setUp' === $tokens[$name]['content']) {
                                $setupFunction = $function;

                                break;
                            }

                            $function = $phpcsFile->findNext(T_FUNCTION, ($function + 1), $end);
                        }
                    }
                }
            }//end foreach
        }//end if

        if (null !== $setupFunction) {
            $start = ($tokens[$setupFunction]['scope_opener'] + 1);
            $end = $tokens[$setupFunction]['scope_closer'];
            for ($i = $start; $i < $end; ++$i) {
                $name = $this->getIncludedClassFromToken($phpcsFile, $tokens, $i);
                if (false !== $name) {
                    $includedClasses[$name] = true;
                }
            }
        }//end if

        if (false === isset($includedClasses[strtolower($className)])) {
            $error = 'Static method called on non-included class or system "%s"; include system with Channels::includeSystem() or include class with require_once';
            $data = [$className];
            $phpcsFile->addError($error, $stackPtr, 'NotIncludedCall', $data);
        }
    }

    //end processTokenWithinScope()

    /**
     * Processes a token within the scope that this test is listening to.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file where the token was found.
     * @param int                         $stackPtr  The position in the stack where
     *                                               this token was found.
     */
    protected function processTokenOutsideScope(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (T_EXTENDS === $tokens[$stackPtr]['code']) {
            // Find the class name.
            $classNameToken = $phpcsFile->findNext(T_STRING, ($stackPtr + 1));
            $className = $tokens[$classNameToken]['content'];
        } else {
            // Determine the name of the class that the static function
            // is being called on. But don't process class names represented by
            // variables as this can be an inexact science.
            $classNameToken = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);
            if (T_VARIABLE === $tokens[$classNameToken]['code']) {
                return;
            }

            $className = $tokens[$classNameToken]['content'];
        }

        // Some systems are always available.
        if (true === isset($this->ignore[strtolower($className)])) {
            return;
        }

        $includedClasses = [];

        $fileName = strtolower($phpcsFile->getFilename());
        $matches = [];
        if (0 !== preg_match('|/systems/([^/]+)/([^/]+)?actions.inc$|', $fileName, $matches)) {
            // This is an actions file, which means we don't
            // have to include the system in which it exists
            // We know the system from the path.
            $includedClasses[$matches[1]] = true;
        }

        // Go searching for includeSystem, includeAsset or require/include
        // calls outside our scope.
        for ($i = 0; $i < $stackPtr; ++$i) {
            // Skip classes and functions as will we never get
            // into their scopes when including this file, although
            // we have a chance of getting into IF, WHILE etc.
            if ((T_CLASS === $tokens[$i]['code']
                || T_INTERFACE === $tokens[$i]['code']
                || T_FUNCTION === $tokens[$i]['code'])
                && true === isset($tokens[$i]['scope_closer'])
            ) {
                $i = $tokens[$i]['scope_closer'];

                continue;
            }

            $name = $this->getIncludedClassFromToken($phpcsFile, $tokens, $i);
            if (false !== $name) {
                $includedClasses[$name] = true;
            // Special case for Widgets cause they are, well, special.
            } elseif ('includewidget' === strtolower($tokens[$i]['content'])) {
                $typeName = $phpcsFile->findNext(T_CONSTANT_ENCAPSED_STRING, ($i + 1));
                $typeName = trim($tokens[$typeName]['content'], " '");
                $includedClasses[strtolower($typeName) . 'widgettype'] = true;
            }
        }//end for

        if (false === isset($includedClasses[strtolower($className)])) {
            if (T_EXTENDS === $tokens[$stackPtr]['code']) {
                $error = 'Class extends non-included class or system "%s"; include system with Channels::includeSystem() or include class with require_once';
                $data = [$className];
                $phpcsFile->addError($error, $stackPtr, 'NotIncludedExtends', $data);
            } else {
                $error = 'Static method called on non-included class or system "%s"; include system with Channels::includeSystem() or include class with require_once';
                $data = [$className];
                $phpcsFile->addError($error, $stackPtr, 'NotIncludedCall', $data);
            }
        }
    }

    //end processTokenOutsideScope()

    /**
     * Determines the included class name from given token.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file where this token was found.
     * @param array                       $tokens    The array of file tokens.
     * @param int                         $stackPtr  The position in the tokens array of the
     *                                               potentially included class.
     *
     * @return string
     */
    protected function getIncludedClassFromToken(File $phpcsFile, array $tokens, $stackPtr)
    {
        if ('includesystem' === strtolower($tokens[$stackPtr]['content'])) {
            $systemName = $phpcsFile->findNext(T_CONSTANT_ENCAPSED_STRING, ($stackPtr + 1));
            $systemName = trim($tokens[$systemName]['content'], " '");

            return strtolower($systemName);
        }
        if ('includeasset' === strtolower($tokens[$stackPtr]['content'])) {
            $typeName = $phpcsFile->findNext(T_CONSTANT_ENCAPSED_STRING, ($stackPtr + 1));
            $typeName = trim($tokens[$typeName]['content'], " '");

            return strtolower($typeName) . 'assettype';
        }
        if (true === isset(Tokens::$includeTokens[$tokens[$stackPtr]['code']])) {
            $filePath = $phpcsFile->findNext(T_CONSTANT_ENCAPSED_STRING, ($stackPtr + 1));
            $filePath = $tokens[$filePath]['content'];
            $filePath = trim($filePath, " '");
            $filePath = basename($filePath, '.inc');

            return strtolower($filePath);
        }

        return false;
    }

    //end getIncludedClassFromToken()
}//end class
