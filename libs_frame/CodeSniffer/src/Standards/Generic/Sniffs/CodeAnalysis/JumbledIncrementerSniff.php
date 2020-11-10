<?php
/**
 * Detects incrementer jumbling in for loops.
 *
 * This rule is based on the PMD rule catalogue. The jumbling incrementer sniff
 * detects the usage of one and the same incrementer into an outer and an inner
 * loop. Even it is intended this is confusing code.
 *
 * <code>
 * class Foo
 * {
 *     public function bar($x)
 *     {
 *         for ($i = 0; $i < 10; $i++)
 *         {
 *             for ($k = 0; $k < 20; $i++)
 *             {
 *                 echo 'Hello';
 *             }
 *         }
 *     }
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

class JumbledIncrementerSniff implements Sniff
{
    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @return int[]
     */
    public function register()
    {
        return [T_FOR];
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

        // Skip for-loop without body.
        if (false === isset($token['scope_opener'])) {
            return;
        }

        // Find incrementors for outer loop.
        $outer = $this->findIncrementers($tokens, $token);

        // Skip if empty.
        if (0 === \count($outer)) {
            return;
        }

        // Find nested for loops.
        $start = ++$token['scope_opener'];
        $end = --$token['scope_closer'];

        for (; $start <= $end; ++$start) {
            if (T_FOR !== $tokens[$start]['code']) {
                continue;
            }

            $inner = $this->findIncrementers($tokens, $tokens[$start]);
            $diff = array_intersect($outer, $inner);

            if (0 !== \count($diff)) {
                $error = 'Loop incrementor (%s) jumbling with inner loop';
                $data = [implode(', ', $diff)];
                $phpcsFile->addWarning($error, $stackPtr, 'Found', $data);
            }
        }
    }

    //end process()

    /**
     * Get all used variables in the incrementer part of a for statement.
     *
     * @param array(integer=>array) $tokens Array with all code sniffer tokens.
     * @param array(string=>mixed)  $token  Current for loop token
     *
     * @return string[] List of all found incrementer variables.
     */
    protected function findIncrementers(array $tokens, array $token)
    {
        // Skip invalid statement.
        if (false === isset($token['parenthesis_opener'])) {
            return [];
        }

        $start = ++$token['parenthesis_opener'];
        $end = --$token['parenthesis_closer'];

        $incrementers = [];
        $semicolons = 0;
        for ($next = $start; $next <= $end; ++$next) {
            $code = $tokens[$next]['code'];
            if (T_SEMICOLON === $code) {
                ++$semicolons;
            } elseif (2 === $semicolons && T_VARIABLE === $code) {
                $incrementers[] = $tokens[$next]['content'];
            }
        }

        return $incrementers;
    }

    //end findIncrementers()
}//end class
