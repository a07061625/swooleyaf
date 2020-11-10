<?php
/**
 * Detects unnecessary overridden methods that simply call their parent.
 *
 * This rule is based on the PMD rule catalogue. The Useless Overriding Method
 * sniff detects the use of methods that only call their parent class's method
 * with the same name and arguments. These methods are not required.
 *
 * <code>
 * class FooBar {
 *   public function __construct($a, $b) {
 *     parent::__construct($a, $b);
 *   }
 * }
 * </code>
 *
 * @author    Manuel Pichler <mapi@manuel-pichler.de>
 * @copyright 2007-2014 Manuel Pichler. All rights reserved.
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class UselessOverridingMethodSniff implements Sniff
{
    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @return int[]
     */
    public function register()
    {
        return [T_FUNCTION];
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
        $token = $tokens[$stackPtr];

        // Skip function without body.
        if (false === isset($token['scope_opener'])) {
            return;
        }

        // Get function name.
        $methodName = $phpcsFile->getDeclarationName($stackPtr);

        // Get all parameters from method signature.
        $signature = [];
        foreach ($phpcsFile->getMethodParameters($stackPtr) as $param) {
            $signature[] = $param['name'];
        }

        $next = ++$token['scope_opener'];
        $end = --$token['scope_closer'];

        for (; $next <= $end; ++$next) {
            $code = $tokens[$next]['code'];

            if (true === isset(Tokens::$emptyTokens[$code])) {
                continue;
            }
            if (T_RETURN === $code) {
                continue;
            }

            break;
        }

        // Any token except 'parent' indicates correct code.
        if (T_PARENT !== $tokens[$next]['code']) {
            return;
        }

        // Find next non empty token index, should be double colon.
        $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($next + 1), null, true);

        // Skip for invalid code.
        if (false === $next || T_DOUBLE_COLON !== $tokens[$next]['code']) {
            return;
        }

        // Find next non empty token index, should be the function name.
        $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($next + 1), null, true);

        // Skip for invalid code or other method.
        if (false === $next || $tokens[$next]['content'] !== $methodName) {
            return;
        }

        // Find next non empty token index, should be the open parenthesis.
        $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($next + 1), null, true);

        // Skip for invalid code.
        if (false === $next || T_OPEN_PARENTHESIS !== $tokens[$next]['code']) {
            return;
        }

        $parameters = [''];
        $parenthesisCount = 1;
        $count = \count($tokens);
        for (++$next; $next < $count; ++$next) {
            $code = $tokens[$next]['code'];

            if (T_OPEN_PARENTHESIS === $code) {
                ++$parenthesisCount;
            } elseif (T_CLOSE_PARENTHESIS === $code) {
                --$parenthesisCount;
            } elseif (1 === $parenthesisCount && T_COMMA === $code) {
                $parameters[] = '';
            } elseif (false === isset(Tokens::$emptyTokens[$code])) {
                $parameters[(\count($parameters) - 1)] .= $tokens[$next]['content'];
            }

            if (0 === $parenthesisCount) {
                break;
            }
        }//end for

        $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($next + 1), null, true);
        if (false === $next || T_SEMICOLON !== $tokens[$next]['code']) {
            return;
        }

        // Check rest of the scope.
        for (++$next; $next <= $end; ++$next) {
            $code = $tokens[$next]['code'];
            // Skip for any other content.
            if (false === isset(Tokens::$emptyTokens[$code])) {
                return;
            }
        }

        $parameters = array_map('trim', $parameters);
        $parameters = array_filter($parameters);

        if (\count($parameters) === \count($signature) && $parameters === $signature) {
            $phpcsFile->addWarning('Possible useless method overriding detected', $stackPtr, 'Found');
        }
    }

    //end process()
}//end class
