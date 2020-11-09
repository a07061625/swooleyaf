<?php
/**
 * Ensures a file declares new symbols and causes no other side effects, or executes logic with side effects, but not both.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\PSR1\Sniffs\Files;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class SideEffectsSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_OPEN_TAG];
    }

    //end register()

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the token stack.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $result = $this->searchForConflict($phpcsFile, 0, ($phpcsFile->numTokens - 1), $tokens);

        if (null !== $result['symbol'] && null !== $result['effect']) {
            $error = 'A file should declare new symbols (classes, functions, constants, etc.) and cause no other side effects, or it should execute logic with side effects, but should not do both. The first symbol is defined on line %s and the first side effect is on line %s.';
            $data = [
                $tokens[$result['symbol']]['line'],
                $tokens[$result['effect']]['line'],
            ];
            $phpcsFile->addWarning($error, 0, 'FoundWithSymbols', $data);
            $phpcsFile->recordMetric($stackPtr, 'Declarations and side effects mixed', 'yes');
        } else {
            $phpcsFile->recordMetric($stackPtr, 'Declarations and side effects mixed', 'no');
        }

        // Ignore the rest of the file.
        return $phpcsFile->numTokens + 1;
    }

    //end process()

    /**
     * Searches for symbol declarations and side effects.
     *
     * Returns the positions of both the first symbol declared and the first
     * side effect in the file. A NULL value for either indicates nothing was
     * found.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $start     The token to start searching from.
     * @param int                         $end       The token to search to.
     * @param array                       $tokens    The stack of tokens that make up
     *                                               the file.
     *
     * @return array
     */
    private function searchForConflict($phpcsFile, $start, $end, $tokens)
    {
        $symbols = [
            T_CLASS => T_CLASS,
            T_INTERFACE => T_INTERFACE,
            T_TRAIT => T_TRAIT,
            T_FUNCTION => T_FUNCTION,
        ];

        $conditions = [
            T_IF => T_IF,
            T_ELSE => T_ELSE,
            T_ELSEIF => T_ELSEIF,
        ];

        $checkAnnotations = $phpcsFile->config->annotations;

        $firstSymbol = null;
        $firstEffect = null;
        for ($i = $start; $i <= $end; ++$i) {
            // Respect phpcs:disable comments.
            if (true === $checkAnnotations
                && T_PHPCS_DISABLE === $tokens[$i]['code']
                && (true === empty($tokens[$i]['sniffCodes'])
                || true === isset($tokens[$i]['sniffCodes']['PSR1'])
                || true === isset($tokens[$i]['sniffCodes']['PSR1.Files'])
                || true === isset($tokens[$i]['sniffCodes']['PSR1.Files.SideEffects']))
            ) {
                do {
                    $i = $phpcsFile->findNext(T_PHPCS_ENABLE, ($i + 1));
                } while (false !== $i
                    && false === empty($tokens[$i]['sniffCodes'])
                    && false === isset($tokens[$i]['sniffCodes']['PSR1'])
                    && false === isset($tokens[$i]['sniffCodes']['PSR1.Files'])
                    && false === isset($tokens[$i]['sniffCodes']['PSR1.Files.SideEffects']));

                if (false === $i) {
                    // The entire rest of the file is disabled,
                    // so return what we have so far.
                    break;
                }

                continue;
            }

            // Ignore whitespace and comments.
            if (true === isset(Tokens::$emptyTokens[$tokens[$i]['code']])) {
                continue;
            }

            // Ignore PHP tags.
            if (T_OPEN_TAG === $tokens[$i]['code']
                || T_CLOSE_TAG === $tokens[$i]['code']
            ) {
                continue;
            }

            // Ignore shebang.
            if ('#!' === substr($tokens[$i]['content'], 0, 2)) {
                continue;
            }

            // Ignore logical operators.
            if (true === isset(Tokens::$booleanOperators[$tokens[$i]['code']])) {
                continue;
            }

            // Ignore entire namespace, declare, const and use statements.
            if (T_NAMESPACE === $tokens[$i]['code']
                || T_USE === $tokens[$i]['code']
                || T_DECLARE === $tokens[$i]['code']
                || T_CONST === $tokens[$i]['code']
            ) {
                if (true === isset($tokens[$i]['scope_opener'])) {
                    $i = $tokens[$i]['scope_closer'];
                    if (T_ENDDECLARE === $tokens[$i]['code']) {
                        $semicolon = $phpcsFile->findNext(Tokens::$emptyTokens, ($i + 1), null, true);
                        if (false !== $semicolon && T_SEMICOLON === $tokens[$semicolon]['code']) {
                            $i = $semicolon;
                        }
                    }
                } else {
                    $semicolon = $phpcsFile->findNext(T_SEMICOLON, ($i + 1));
                    if (false !== $semicolon) {
                        $i = $semicolon;
                    }
                }

                continue;
            }

            // Ignore function/class prefixes.
            if (true === isset(Tokens::$methodPrefixes[$tokens[$i]['code']])) {
                continue;
            }

            // Ignore anon classes.
            if (T_ANON_CLASS === $tokens[$i]['code']) {
                $i = $tokens[$i]['scope_closer'];

                continue;
            }

            // Detect and skip over symbols.
            if (true === isset($symbols[$tokens[$i]['code']])
                && true === isset($tokens[$i]['scope_closer'])
            ) {
                if (null === $firstSymbol) {
                    $firstSymbol = $i;
                }

                $i = $tokens[$i]['scope_closer'];

                continue;
            }
            if (T_STRING === $tokens[$i]['code']
                && 'define' === strtolower($tokens[$i]['content'])
            ) {
                $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($i - 1), null, true);
                if (T_OBJECT_OPERATOR !== $tokens[$prev]['code']
                    && T_NULLSAFE_OBJECT_OPERATOR !== $tokens[$prev]['code']
                    && T_DOUBLE_COLON !== $tokens[$prev]['code']
                    && T_FUNCTION !== $tokens[$prev]['code']
                ) {
                    if (null === $firstSymbol) {
                        $firstSymbol = $i;
                    }

                    $semicolon = $phpcsFile->findNext(T_SEMICOLON, ($i + 1));
                    if (false !== $semicolon) {
                        $i = $semicolon;
                    }

                    continue;
                }
            }//end if

            // Special case for defined() as it can be used to see
            // if a constant (a symbol) should be defined or not and
            // doesn't need to use a full conditional block.
            if (T_STRING === $tokens[$i]['code']
                && 'defined' === strtolower($tokens[$i]['content'])
            ) {
                $openBracket = $phpcsFile->findNext(Tokens::$emptyTokens, ($i + 1), null, true);
                if (false !== $openBracket
                    && T_OPEN_PARENTHESIS === $tokens[$openBracket]['code']
                    && true === isset($tokens[$openBracket]['parenthesis_closer'])
                ) {
                    $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($i - 1), null, true);
                    if (T_OBJECT_OPERATOR !== $tokens[$prev]['code']
                        && T_NULLSAFE_OBJECT_OPERATOR !== $tokens[$prev]['code']
                        && T_DOUBLE_COLON !== $tokens[$prev]['code']
                        && T_FUNCTION !== $tokens[$prev]['code']
                    ) {
                        $i = $tokens[$openBracket]['parenthesis_closer'];

                        continue;
                    }
                }
            }//end if

            // Conditional statements are allowed in symbol files as long as the
            // contents is only a symbol definition. So don't count these as effects
            // in this case.
            if (true === isset($conditions[$tokens[$i]['code']])) {
                if (false === isset($tokens[$i]['scope_opener'])) {
                    // Probably an "else if", so just ignore.
                    continue;
                }

                $result = $this->searchForConflict(
                    $phpcsFile,
                    ($tokens[$i]['scope_opener'] + 1),
                    ($tokens[$i]['scope_closer'] - 1),
                    $tokens
                );

                if (null !== $result['symbol']) {
                    if (null === $firstSymbol) {
                        $firstSymbol = $result['symbol'];
                    }

                    if (null !== $result['effect']) {
                        // Found a conflict.
                        $firstEffect = $result['effect'];

                        break;
                    }
                }

                if (null === $firstEffect) {
                    $firstEffect = $result['effect'];
                }

                $i = $tokens[$i]['scope_closer'];

                continue;
            }//end if

            if (null === $firstEffect) {
                $firstEffect = $i;
            }

            if (null !== $firstSymbol) {
                // We have a conflict we have to report, so no point continuing.
                break;
            }
        }//end for

        return [
            'symbol' => $firstSymbol,
            'effect' => $firstEffect,
        ];
    }

    //end searchForConflict()
}//end class
