<?php
/**
 * Verifies that inline control statements are not present.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\ControlStructures;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class InlineControlStructureSniff implements Sniff
{
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
     * If true, an error will be thrown; otherwise a warning.
     *
     * @var bool
     */
    public $error = true;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_IF,
            T_ELSE,
            T_ELSEIF,
            T_FOREACH,
            T_WHILE,
            T_DO,
            T_SWITCH,
            T_FOR,
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

        if (true === isset($tokens[$stackPtr]['scope_opener'])) {
            $phpcsFile->recordMetric($stackPtr, 'Control structure defined inline', 'no');

            return;
        }

        // Ignore the ELSE in ELSE IF. We'll process the IF part later.
        if (T_ELSE === $tokens[$stackPtr]['code']) {
            $next = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
            if (T_IF === $tokens[$next]['code']) {
                return;
            }
        }

        if (T_WHILE === $tokens[$stackPtr]['code'] || T_FOR === $tokens[$stackPtr]['code']) {
            // This could be from a DO WHILE, which doesn't have an opening brace or a while/for without body.
            if (true === isset($tokens[$stackPtr]['parenthesis_closer'])) {
                $afterParensCloser = $phpcsFile->findNext(Tokens::$emptyTokens, ($tokens[$stackPtr]['parenthesis_closer'] + 1), null, true);
                if (false === $afterParensCloser) {
                    // Live coding.
                    return;
                }

                if (T_SEMICOLON === $tokens[$afterParensCloser]['code']) {
                    $phpcsFile->recordMetric($stackPtr, 'Control structure defined inline', 'no');

                    return;
                }
            }

            // In Javascript DO WHILE loops without curly braces are legal. This
            // is only valid if a single statement is present between the DO and
            // the WHILE. We can detect this by checking only a single semicolon
            // is present between them.
            if (T_WHILE === $tokens[$stackPtr]['code'] && 'JS' === $phpcsFile->tokenizerType) {
                $lastDo = $phpcsFile->findPrevious(T_DO, ($stackPtr - 1));
                $lastSemicolon = $phpcsFile->findPrevious(T_SEMICOLON, ($stackPtr - 1));
                if (false !== $lastDo && false !== $lastSemicolon && $lastDo < $lastSemicolon) {
                    $precedingSemicolon = $phpcsFile->findPrevious(T_SEMICOLON, ($lastSemicolon - 1));
                    if (false === $precedingSemicolon || $precedingSemicolon < $lastDo) {
                        return;
                    }
                }
            }
        }//end if

        if (false === isset($tokens[$stackPtr]['parenthesis_opener'], $tokens[$stackPtr]['parenthesis_closer'])
            && T_ELSE !== $tokens[$stackPtr]['code']
        ) {
            if (T_DO !== $tokens[$stackPtr]['code']) {
                // Live coding or parse error.
                return;
            }

            $nextWhile = $phpcsFile->findNext(T_WHILE, ($stackPtr + 1));
            if (false !== $nextWhile
                && false === isset($tokens[$nextWhile]['parenthesis_opener'], $tokens[$nextWhile]['parenthesis_closer'])
            ) {
                // Live coding or parse error.
                return;
            }

            unset($nextWhile);
        }

        $start = $stackPtr;
        if (true === isset($tokens[$stackPtr]['parenthesis_closer'])) {
            $start = $tokens[$stackPtr]['parenthesis_closer'];
        }

        $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($start + 1), null, true);
        if (false === $nextNonEmpty) {
            // Live coding or parse error.
            return;
        }

        if (T_OPEN_CURLY_BRACKET === $tokens[$nextNonEmpty]['code']
            || T_COLON === $tokens[$nextNonEmpty]['code']
        ) {
            // T_CLOSE_CURLY_BRACKET missing, or alternative control structure with
            // T_END... missing. Either live coding, parse error or end
            // tag in short open tags and scan run with short_open_tag=Off.
            // Bow out completely as any further detection will be unreliable
            // and create incorrect fixes or cause fixer conflicts.
            return $phpcsFile->numTokens + 1;
        }

        unset($nextNonEmpty, $start);

        // This is a control structure without an opening brace,
        // so it is an inline statement.
        if (true === $this->error) {
            $fix = $phpcsFile->addFixableError('Inline control structures are not allowed', $stackPtr, 'NotAllowed');
        } else {
            $fix = $phpcsFile->addFixableWarning('Inline control structures are discouraged', $stackPtr, 'Discouraged');
        }

        $phpcsFile->recordMetric($stackPtr, 'Control structure defined inline', 'yes');

        // Stop here if we are not fixing the error.
        if (true !== $fix) {
            return;
        }

        $phpcsFile->fixer->beginChangeset();
        if (true === isset($tokens[$stackPtr]['parenthesis_closer'])) {
            $closer = $tokens[$stackPtr]['parenthesis_closer'];
        } else {
            $closer = $stackPtr;
        }

        if (T_WHITESPACE === $tokens[($closer + 1)]['code']
            || T_SEMICOLON === $tokens[($closer + 1)]['code']
        ) {
            $phpcsFile->fixer->addContent($closer, ' {');
        } else {
            $phpcsFile->fixer->addContent($closer, ' { ');
        }

        $fixableScopeOpeners = $this->register();

        $lastNonEmpty = $closer;
        for ($end = ($closer + 1); $end < $phpcsFile->numTokens; ++$end) {
            if (T_SEMICOLON === $tokens[$end]['code']) {
                break;
            }

            if (T_CLOSE_TAG === $tokens[$end]['code']) {
                $end = $lastNonEmpty;

                break;
            }

            if (true === \in_array($tokens[$end]['code'], $fixableScopeOpeners, true)
                && false === isset($tokens[$end]['scope_opener'])
            ) {
                // The best way to fix nested inline scopes is middle-out.
                // So skip this one. It will be detected and fixed on a future loop.
                $phpcsFile->fixer->rollbackChangeset();

                return;
            }

            if (true === isset($tokens[$end]['scope_opener'])) {
                $type = $tokens[$end]['code'];
                $end = $tokens[$end]['scope_closer'];
                if (T_DO === $type || T_IF === $type || T_ELSEIF === $type || T_TRY === $type) {
                    $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($end + 1), null, true);
                    if (false === $next) {
                        break;
                    }

                    $nextType = $tokens[$next]['code'];

                    // Let additional conditions loop and find their ending.
                    if ((T_IF === $type
                        || T_ELSEIF === $type)
                        && (T_ELSEIF === $nextType
                        || T_ELSE === $nextType)
                    ) {
                        continue;
                    }

                    // Account for DO... WHILE conditions.
                    if (T_DO === $type && T_WHILE === $nextType) {
                        $end = $phpcsFile->findNext(T_SEMICOLON, ($next + 1));
                    }

                    // Account for TRY... CATCH statements.
                    if (T_TRY === $type && T_CATCH === $nextType) {
                        $end = $tokens[$next]['scope_closer'];
                    }
                } elseif (T_CLOSURE === $type) {
                    // There should be a semicolon after the closing brace.
                    $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($end + 1), null, true);
                    if (false !== $next && T_SEMICOLON === $tokens[$next]['code']) {
                        $end = $next;
                    }
                }//end if

                if (T_END_HEREDOC !== $tokens[$end]['code']
                    && T_END_NOWDOC !== $tokens[$end]['code']
                ) {
                    break;
                }
            }//end if

            if (true === isset($tokens[$end]['parenthesis_closer'])) {
                $end = $tokens[$end]['parenthesis_closer'];
                $lastNonEmpty = $end;

                continue;
            }

            if (T_WHITESPACE !== $tokens[$end]['code']) {
                $lastNonEmpty = $end;
            }
        }//end for

        if ($end === $phpcsFile->numTokens) {
            $end = $lastNonEmpty;
        }

        $nextContent = $phpcsFile->findNext(Tokens::$emptyTokens, ($end + 1), null, true);
        if (false === $nextContent || $tokens[$nextContent]['line'] !== $tokens[$end]['line']) {
            // Looks for completely empty statements.
            $next = $phpcsFile->findNext(T_WHITESPACE, ($closer + 1), ($end + 1), true);
        } else {
            $next = ($end + 1);
            $endLine = $end;
        }

        if ($next !== $end) {
            if (false === $nextContent || $tokens[$nextContent]['line'] !== $tokens[$end]['line']) {
                // Account for a comment on the end of the line.
                for ($endLine = $end; $endLine < $phpcsFile->numTokens; ++$endLine) {
                    if (false === isset($tokens[($endLine + 1)])
                        || $tokens[$endLine]['line'] !== $tokens[($endLine + 1)]['line']
                    ) {
                        break;
                    }
                }

                if (false === isset(Tokens::$commentTokens[$tokens[$endLine]['code']])
                    && (T_WHITESPACE !== $tokens[$endLine]['code']
                    || false === isset(Tokens::$commentTokens[$tokens[($endLine - 1)]['code']]))
                ) {
                    $endLine = $end;
                }
            }

            if ($endLine !== $end) {
                $endToken = $endLine;
                $addedContent = '';
            } else {
                $endToken = $end;
                $addedContent = $phpcsFile->eolChar;

                if (T_SEMICOLON !== $tokens[$end]['code']
                    && T_CLOSE_CURLY_BRACKET !== $tokens[$end]['code']
                ) {
                    $phpcsFile->fixer->addContent($end, '; ');
                }
            }

            $next = $phpcsFile->findNext(T_WHITESPACE, ($endToken + 1), null, true);
            if (false !== $next
                && (T_ELSE === $tokens[$next]['code']
                || T_ELSEIF === $tokens[$next]['code'])
            ) {
                $phpcsFile->fixer->addContentBefore($next, '} ');
            } else {
                $indent = '';
                for ($first = $stackPtr; $first > 0; --$first) {
                    if (1 === $tokens[$first]['column']) {
                        break;
                    }
                }

                if (T_WHITESPACE === $tokens[$first]['code']) {
                    $indent = $tokens[$first]['content'];
                } elseif (T_INLINE_HTML === $tokens[$first]['code']
                    || T_OPEN_TAG === $tokens[$first]['code']
                ) {
                    $addedContent = '';
                }

                $addedContent .= $indent . '}';
                if (false !== $next && T_COMMENT === $tokens[$endToken]['code']) {
                    $addedContent .= $phpcsFile->eolChar;
                }

                $phpcsFile->fixer->addContent($endToken, $addedContent);
            }//end if
        } else {
            if (false === $nextContent || $tokens[$nextContent]['line'] !== $tokens[$end]['line']) {
                // Account for a comment on the end of the line.
                for ($endLine = $end; $endLine < $phpcsFile->numTokens; ++$endLine) {
                    if (false === isset($tokens[($endLine + 1)])
                        || $tokens[$endLine]['line'] !== $tokens[($endLine + 1)]['line']
                    ) {
                        break;
                    }
                }

                if (T_COMMENT !== $tokens[$endLine]['code']
                    && (T_WHITESPACE !== $tokens[$endLine]['code']
                    || T_COMMENT !== $tokens[($endLine - 1)]['code'])
                ) {
                    $endLine = $end;
                }
            }

            if ($endLine !== $end) {
                $phpcsFile->fixer->replaceToken($end, '');
                $phpcsFile->fixer->addNewlineBefore($endLine);
                $phpcsFile->fixer->addContent($endLine, '}');
            } else {
                $phpcsFile->fixer->replaceToken($end, '}');
            }
        }//end if

        $phpcsFile->fixer->endChangeset();
    }

    //end process()
}//end class
