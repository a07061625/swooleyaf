<?php
/**
 * Ban the use of Yoda conditions.
 *
 * @author    Mponos George <gmponos@gmail.com>
 * @author    Mark Scherer <username@example.com>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\ControlStructures;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class DisallowYodaConditionsSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return Tokens::$comparisonTokens;
    }

    //end register()

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in the
     *                                               stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $previousIndex = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
        $relevantTokens = [
            T_CLOSE_SHORT_ARRAY,
            T_CLOSE_PARENTHESIS,
            T_TRUE,
            T_FALSE,
            T_NULL,
            T_LNUMBER,
            T_DNUMBER,
            T_CONSTANT_ENCAPSED_STRING,
        ];

        if (false === $previousIndex
            || false === \in_array($tokens[$previousIndex]['code'], $relevantTokens, true)
        ) {
            return;
        }

        if (T_CLOSE_SHORT_ARRAY === $tokens[$previousIndex]['code']) {
            $previousIndex = $tokens[$previousIndex]['bracket_opener'];
            if (false === $this->isArrayStatic($phpcsFile, $previousIndex)) {
                return;
            }
        }

        $prevIndex = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($previousIndex - 1), null, true);
        if (false === $prevIndex) {
            return;
        }

        if (true === \in_array($tokens[$prevIndex]['code'], Tokens::$arithmeticTokens, true)) {
            return;
        }

        if (T_STRING_CONCAT === $tokens[$prevIndex]['code']) {
            return;
        }

        // Is it a parenthesis.
        if (T_CLOSE_PARENTHESIS === $tokens[$previousIndex]['code']) {
            // Check what exists inside the parenthesis.
            $closeParenthesisIndex = $phpcsFile->findPrevious(
                Tokens::$emptyTokens,
                ($tokens[$previousIndex]['parenthesis_opener'] - 1),
                null,
                true
            );

            if (false === $closeParenthesisIndex || T_ARRAY !== $tokens[$closeParenthesisIndex]['code']) {
                if (T_STRING === $tokens[$closeParenthesisIndex]['code']) {
                    return;
                }

                // If it is not an array check what is inside.
                $found = $phpcsFile->findPrevious(
                    T_VARIABLE,
                    ($previousIndex - 1),
                    $tokens[$previousIndex]['parenthesis_opener']
                );

                // If a variable exists, it is not Yoda.
                if (false !== $found) {
                    return;
                }

                // If there is nothing inside the parenthesis, it it not a Yoda.
                $opener = $tokens[$previousIndex]['parenthesis_opener'];
                $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($previousIndex - 1), ($opener + 1), true);
                if (false === $prev) {
                    return;
                }
            } elseif (T_ARRAY === $tokens[$closeParenthesisIndex]['code']
                && false === $this->isArrayStatic($phpcsFile, $closeParenthesisIndex)
            ) {
                return;
            }//end if
        }//end if

        $phpcsFile->addError(
            'Usage of Yoda conditions is not allowed; switch the expression order',
            $stackPtr,
            'Found'
        );
    }

    //end process()

    /**
     * Determines if an array is a static definition.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile  The file being scanned.
     * @param int                         $arrayToken The position of the array token.
     *
     * @return bool
     */
    public function isArrayStatic(File $phpcsFile, $arrayToken)
    {
        $tokens = $phpcsFile->getTokens();

        $arrayEnd = null;
        if (T_OPEN_SHORT_ARRAY === $tokens[$arrayToken]['code']) {
            $start = $arrayToken;
            $end = $tokens[$arrayToken]['bracket_closer'];
        } elseif (T_ARRAY === $tokens[$arrayToken]['code']) {
            $start = $tokens[$arrayToken]['parenthesis_opener'];
            $end = $tokens[$arrayToken]['parenthesis_closer'];
        } else {
            return true;
        }

        $staticTokens = Tokens::$emptyTokens;
        $staticTokens += Tokens::$textStringTokens;
        $staticTokens += Tokens::$assignmentTokens;
        $staticTokens += Tokens::$equalityTokens;
        $staticTokens += Tokens::$comparisonTokens;
        $staticTokens += Tokens::$arithmeticTokens;
        $staticTokens += Tokens::$operators;
        $staticTokens += Tokens::$booleanOperators;
        $staticTokens += Tokens::$castTokens;
        $staticTokens += Tokens::$bracketTokens;
        $staticTokens += [
            T_DOUBLE_ARROW => T_DOUBLE_ARROW,
            T_COMMA => T_COMMA,
            T_TRUE => T_TRUE,
            T_FALSE => T_FALSE,
        ];

        for ($i = ($start + 1); $i < $end; ++$i) {
            if (true === isset($tokens[$i]['scope_closer'])) {
                $i = $tokens[$i]['scope_closer'];

                continue;
            }

            if (false === isset($staticTokens[$tokens[$i]['code']])) {
                return false;
            }
        }

        return true;
    }

    //end isArrayStatic()
}//end class
