<?php
/**
 * Verifies that control statements conform to their coding standards.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\ControlStructures;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class ControlSignatureSniff implements Sniff
{
    /**
     * How many spaces should precede the colon if using alternative syntax.
     *
     * @var int
     */
    public $requiredSpacesBeforeColon = 1;

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
     * @return int[]
     */
    public function register()
    {
        return [
            T_TRY,
            T_CATCH,
            T_FINALLY,
            T_DO,
            T_WHILE,
            T_FOR,
            T_IF,
            T_FOREACH,
            T_ELSE,
            T_ELSEIF,
            T_SWITCH,
        ];
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

        $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if (false === $nextNonEmpty) {
            return;
        }

        $isAlternative = false;
        if (true === isset($tokens[$stackPtr]['scope_opener'])
            && T_COLON === $tokens[$tokens[$stackPtr]['scope_opener']]['code']
        ) {
            $isAlternative = true;
        }

        // Single space after the keyword.
        $expected = 1;
        if (false === isset($tokens[$stackPtr]['parenthesis_closer']) && true === $isAlternative) {
            // Catching cases like:
            // if (condition) : ... else: ... endif
            // where there is no condition.
            $expected = (int)$this->requiredSpacesBeforeColon;
        }

        $found = 1;
        if (T_WHITESPACE !== $tokens[($stackPtr + 1)]['code']) {
            $found = 0;
        } elseif (' ' !== $tokens[($stackPtr + 1)]['content']) {
            if (false !== strpos($tokens[($stackPtr + 1)]['content'], $phpcsFile->eolChar)) {
                $found = 'newline';
            } else {
                $found = $tokens[($stackPtr + 1)]['length'];
            }
        }

        if ($found !== $expected) {
            $error = 'Expected %s space(s) after %s keyword; %s found';
            $data = [
                $expected,
                strtoupper($tokens[$stackPtr]['content']),
                $found,
            ];

            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpaceAfterKeyword', $data);
            if (true === $fix) {
                if (0 === $found) {
                    $phpcsFile->fixer->addContent($stackPtr, str_repeat(' ', $expected));
                } else {
                    $phpcsFile->fixer->replaceToken(($stackPtr + 1), str_repeat(' ', $expected));
                }
            }
        }

        // Single space after closing parenthesis.
        if (true === isset($tokens[$stackPtr]['parenthesis_closer'])
            && true === isset($tokens[$stackPtr]['scope_opener'])
        ) {
            $expected = 1;
            if (true === $isAlternative) {
                $expected = (int)$this->requiredSpacesBeforeColon;
            }

            $closer = $tokens[$stackPtr]['parenthesis_closer'];
            $opener = $tokens[$stackPtr]['scope_opener'];
            $content = $phpcsFile->getTokensAsString(($closer + 1), ($opener - $closer - 1));

            if ('' === trim($content)) {
                if (false !== strpos($content, $phpcsFile->eolChar)) {
                    $found = 'newline';
                } else {
                    $found = \strlen($content);
                }
            } else {
                $found = '"' . str_replace($phpcsFile->eolChar, '\n', $content) . '"';
            }

            if ($found !== $expected) {
                $error = 'Expected %s space(s) after closing parenthesis; found %s';
                $data = [
                    $expected,
                    $found,
                ];

                $fix = $phpcsFile->addFixableError($error, $closer, 'SpaceAfterCloseParenthesis', $data);
                if (true === $fix) {
                    $padding = str_repeat(' ', $expected);
                    if ($closer === ($opener - 1)) {
                        $phpcsFile->fixer->addContent($closer, $padding);
                    } else {
                        $phpcsFile->fixer->beginChangeset();
                        if ('' === trim($content)) {
                            $phpcsFile->fixer->addContent($closer, $padding);
                            if (0 !== $found) {
                                for ($i = ($closer + 1); $i < $opener; ++$i) {
                                    $phpcsFile->fixer->replaceToken($i, '');
                                }
                            }
                        } else {
                            $phpcsFile->fixer->addContent($closer, $padding . $tokens[$opener]['content']);
                            $phpcsFile->fixer->replaceToken($opener, '');

                            if ($tokens[$opener]['line'] !== $tokens[$closer]['line']) {
                                $next = $phpcsFile->findNext(T_WHITESPACE, ($opener + 1), null, true);
                                if ($tokens[$next]['line'] !== $tokens[$opener]['line']) {
                                    for ($i = ($opener + 1); $i < $next; ++$i) {
                                        $phpcsFile->fixer->replaceToken($i, '');
                                    }
                                }
                            }
                        }

                        $phpcsFile->fixer->endChangeset();
                    }//end if
                }//end if
            }//end if
        }//end if

        // Single newline after opening brace.
        if (true === isset($tokens[$stackPtr]['scope_opener'])) {
            $opener = $tokens[$stackPtr]['scope_opener'];
            for ($next = ($opener + 1); $next < $phpcsFile->numTokens; ++$next) {
                $code = $tokens[$next]['code'];

                if (T_WHITESPACE === $code
                    || (T_INLINE_HTML === $code
                    && '' === trim($tokens[$next]['content']))
                ) {
                    continue;
                }

                // Skip all empty tokens on the same line as the opener.
                if ($tokens[$next]['line'] === $tokens[$opener]['line']
                    && (true === isset(Tokens::$emptyTokens[$code])
                    || T_CLOSE_TAG === $code)
                ) {
                    continue;
                }

                // We found the first bit of a code, or a comment on the
                // following line.
                break;
            }//end for

            if ($tokens[$next]['line'] === $tokens[$opener]['line']) {
                $error = 'Newline required after opening brace';
                $fix = $phpcsFile->addFixableError($error, $opener, 'NewlineAfterOpenBrace');
                if (true === $fix) {
                    $phpcsFile->fixer->beginChangeset();
                    for ($i = ($opener + 1); $i < $next; ++$i) {
                        if ('' !== trim($tokens[$i]['content'])) {
                            break;
                        }

                        // Remove whitespace.
                        $phpcsFile->fixer->replaceToken($i, '');
                    }

                    $phpcsFile->fixer->addContent($opener, $phpcsFile->eolChar);
                    $phpcsFile->fixer->endChangeset();
                }
            }//end if
        } elseif (T_WHILE === $tokens[$stackPtr]['code']) {
            // Zero spaces after parenthesis closer, but only if followed by a semicolon.
            $closer = $tokens[$stackPtr]['parenthesis_closer'];
            $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($closer + 1), null, true);
            if (false !== $nextNonEmpty && T_SEMICOLON === $tokens[$nextNonEmpty]['code']) {
                $found = 0;
                if (T_WHITESPACE === $tokens[($closer + 1)]['code']) {
                    if (false !== strpos($tokens[($closer + 1)]['content'], $phpcsFile->eolChar)) {
                        $found = 'newline';
                    } else {
                        $found = $tokens[($closer + 1)]['length'];
                    }
                }

                if (0 !== $found) {
                    $error = 'Expected 0 spaces before semicolon; %s found';
                    $data = [$found];
                    $fix = $phpcsFile->addFixableError($error, $closer, 'SpaceBeforeSemicolon', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($closer + 1), '');
                    }
                }
            }
        }//end if

        // Only want to check multi-keyword structures from here on.
        if (T_WHILE === $tokens[$stackPtr]['code']) {
            if (false !== isset($tokens[$stackPtr]['scope_closer'])) {
                return;
            }

            $closer = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
            if (false === $closer
                || T_CLOSE_CURLY_BRACKET !== $tokens[$closer]['code']
                || T_DO !== $tokens[$tokens[$closer]['scope_condition']]['code']
            ) {
                return;
            }
        } elseif (T_ELSE === $tokens[$stackPtr]['code']
            || T_ELSEIF === $tokens[$stackPtr]['code']
            || T_CATCH === $tokens[$stackPtr]['code']
            || T_FINALLY === $tokens[$stackPtr]['code']
        ) {
            if (true === isset($tokens[$stackPtr]['scope_opener'])
                && T_COLON === $tokens[$tokens[$stackPtr]['scope_opener']]['code']
            ) {
                // Special case for alternate syntax, where this token is actually
                // the closer for the previous block, so there is no spacing to check.
                return;
            }

            $closer = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
            if (false === $closer || T_CLOSE_CURLY_BRACKET !== $tokens[$closer]['code']) {
                return;
            }
        } else {
            return;
        }//end if

        // Single space after closing brace.
        $found = 1;
        if (T_WHITESPACE !== $tokens[($closer + 1)]['code']) {
            $found = 0;
        } elseif ($tokens[$closer]['line'] !== $tokens[$stackPtr]['line']) {
            $found = 'newline';
        } elseif (' ' !== $tokens[($closer + 1)]['content']) {
            $found = $tokens[($closer + 1)]['length'];
        }

        if (1 !== $found) {
            $error = 'Expected 1 space after closing brace; %s found';
            $data = [$found];

            if (false !== $phpcsFile->findNext(Tokens::$commentTokens, ($closer + 1), $stackPtr)) {
                // Comment found between closing brace and keyword, don't auto-fix.
                $phpcsFile->addError($error, $closer, 'SpaceAfterCloseBrace', $data);

                return;
            }

            $fix = $phpcsFile->addFixableError($error, $closer, 'SpaceAfterCloseBrace', $data);
            if (true === $fix) {
                if (0 === $found) {
                    $phpcsFile->fixer->addContent($closer, ' ');
                } else {
                    $phpcsFile->fixer->replaceToken(($closer + 1), ' ');
                }
            }
        }
    }

    //end process()
}//end class
