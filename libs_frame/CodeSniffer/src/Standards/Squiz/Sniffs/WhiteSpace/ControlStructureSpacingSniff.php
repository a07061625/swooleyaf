<?php
/**
 * Checks that control structures have the correct spacing around brackets.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class ControlStructureSpacingSniff implements Sniff
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
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_IF,
            T_WHILE,
            T_FOREACH,
            T_FOR,
            T_SWITCH,
            T_DO,
            T_ELSE,
            T_ELSEIF,
            T_TRY,
            T_CATCH,
            T_FINALLY,
        ];
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

        if (true === isset($tokens[$stackPtr]['parenthesis_opener'])
            && true === isset($tokens[$stackPtr]['parenthesis_closer'])
        ) {
            $parenOpener = $tokens[$stackPtr]['parenthesis_opener'];
            $parenCloser = $tokens[$stackPtr]['parenthesis_closer'];
            if (T_WHITESPACE === $tokens[($parenOpener + 1)]['code']) {
                $gap = $tokens[($parenOpener + 1)]['length'];

                if (0 === $gap) {
                    $phpcsFile->recordMetric($stackPtr, 'Spaces after control structure open parenthesis', 'newline');
                    $gap = 'newline';
                } else {
                    $phpcsFile->recordMetric($stackPtr, 'Spaces after control structure open parenthesis', $gap);
                }

                $error = 'Expected 0 spaces after opening bracket; %s found';
                $data = [$gap];
                $fix = $phpcsFile->addFixableError($error, ($parenOpener + 1), 'SpacingAfterOpenBrace', $data);
                if (true === $fix) {
                    $phpcsFile->fixer->replaceToken(($parenOpener + 1), '');
                }
            } else {
                $phpcsFile->recordMetric($stackPtr, 'Spaces after control structure open parenthesis', 0);
            }

            if ($tokens[$parenOpener]['line'] === $tokens[$parenCloser]['line']
                && T_WHITESPACE === $tokens[($parenCloser - 1)]['code']
            ) {
                $gap = $tokens[($parenCloser - 1)]['length'];
                $error = 'Expected 0 spaces before closing bracket; %s found';
                $data = [$gap];
                $fix = $phpcsFile->addFixableError($error, ($parenCloser - 1), 'SpaceBeforeCloseBrace', $data);
                if (true === $fix) {
                    $phpcsFile->fixer->replaceToken(($parenCloser - 1), '');
                }

                if (0 === $gap) {
                    $phpcsFile->recordMetric($stackPtr, 'Spaces before control structure close parenthesis', 'newline');
                } else {
                    $phpcsFile->recordMetric($stackPtr, 'Spaces before control structure close parenthesis', $gap);
                }
            } else {
                $phpcsFile->recordMetric($stackPtr, 'Spaces before control structure close parenthesis', 0);
            }
        }//end if

        if (false === isset($tokens[$stackPtr]['scope_closer'])) {
            return;
        }

        $scopeOpener = $tokens[$stackPtr]['scope_opener'];
        $scopeCloser = $tokens[$stackPtr]['scope_closer'];

        for ($firstContent = ($scopeOpener + 1); $firstContent < $phpcsFile->numTokens; ++$firstContent) {
            $code = $tokens[$firstContent]['code'];

            if (T_WHITESPACE === $code
                || (T_INLINE_HTML === $code
                && '' === trim($tokens[$firstContent]['content']))
            ) {
                continue;
            }

            // Skip all empty tokens on the same line as the opener.
            if ($tokens[$firstContent]['line'] === $tokens[$scopeOpener]['line']
                && (true === isset(Tokens::$emptyTokens[$code])
                || T_CLOSE_TAG === $code)
            ) {
                continue;
            }

            break;
        }

        // We ignore spacing for some structures that tend to have their own rules.
        $ignore = [
            T_FUNCTION => true,
            T_CLASS => true,
            T_INTERFACE => true,
            T_TRAIT => true,
            T_DOC_COMMENT_OPEN_TAG => true,
        ];

        if (false === isset($ignore[$tokens[$firstContent]['code']])
            && $tokens[$firstContent]['line'] >= ($tokens[$scopeOpener]['line'] + 2)
        ) {
            $gap = ($tokens[$firstContent]['line'] - $tokens[$scopeOpener]['line'] - 1);
            $phpcsFile->recordMetric($stackPtr, 'Blank lines at start of control structure', $gap);

            $error = 'Blank line found at start of control structure';
            $fix = $phpcsFile->addFixableError($error, $scopeOpener, 'SpacingAfterOpen');

            if (true === $fix) {
                $phpcsFile->fixer->beginChangeset();
                $i = ($scopeOpener + 1);
                while ($tokens[$i]['line'] !== $tokens[$firstContent]['line']) {
                    // Start removing content from the line after the opener.
                    if ($tokens[$i]['line'] !== $tokens[$scopeOpener]['line']) {
                        $phpcsFile->fixer->replaceToken($i, '');
                    }

                    ++$i;
                }

                $phpcsFile->fixer->endChangeset();
            }
        } else {
            $phpcsFile->recordMetric($stackPtr, 'Blank lines at start of control structure', 0);
        }//end if

        if ($firstContent !== $scopeCloser) {
            $lastContent = $phpcsFile->findPrevious(
                T_WHITESPACE,
                ($scopeCloser - 1),
                null,
                true
            );

            $lastNonEmptyContent = $phpcsFile->findPrevious(
                Tokens::$emptyTokens,
                ($scopeCloser - 1),
                null,
                true
            );

            $checkToken = $lastContent;
            if (true === isset($tokens[$lastNonEmptyContent]['scope_condition'])) {
                $checkToken = $tokens[$lastNonEmptyContent]['scope_condition'];
            }

            if (false === isset($ignore[$tokens[$checkToken]['code']])
                && $tokens[$lastContent]['line'] <= ($tokens[$scopeCloser]['line'] - 2)
            ) {
                $errorToken = $scopeCloser;
                for ($i = ($scopeCloser - 1); $i > $lastContent; --$i) {
                    if ($tokens[$i]['line'] < $tokens[$scopeCloser]['line']) {
                        $errorToken = $i;

                        break;
                    }
                }

                $gap = ($tokens[$scopeCloser]['line'] - $tokens[$lastContent]['line'] - 1);
                $phpcsFile->recordMetric($stackPtr, 'Blank lines at end of control structure', $gap);

                $error = 'Blank line found at end of control structure';
                $fix = $phpcsFile->addFixableError($error, $errorToken, 'SpacingBeforeClose');

                if (true === $fix) {
                    $phpcsFile->fixer->beginChangeset();
                    for ($i = ($scopeCloser - 1); $i > $lastContent; --$i) {
                        if ($tokens[$i]['line'] === $tokens[$scopeCloser]['line']) {
                            continue;
                        }

                        if ($tokens[$i]['line'] === $tokens[$lastContent]['line']) {
                            break;
                        }

                        $phpcsFile->fixer->replaceToken($i, '');
                    }

                    $phpcsFile->fixer->endChangeset();
                }
            } else {
                $phpcsFile->recordMetric($stackPtr, 'Blank lines at end of control structure', 0);
            }//end if
        }//end if

        $trailingContent = $phpcsFile->findNext(
            T_WHITESPACE,
            ($scopeCloser + 1),
            null,
            true
        );

        if (T_COMMENT === $tokens[$trailingContent]['code']
            || true === isset(Tokens::$phpcsCommentTokens[$tokens[$trailingContent]['code']])
        ) {
            // Special exception for code where the comment about
            // an ELSE or ELSEIF is written between the control structures.
            $nextCode = $phpcsFile->findNext(
                Tokens::$emptyTokens,
                ($scopeCloser + 1),
                null,
                true
            );

            if (T_ELSE === $tokens[$nextCode]['code']
                || T_ELSEIF === $tokens[$nextCode]['code']
                || $tokens[$trailingContent]['line'] === $tokens[$scopeCloser]['line']
            ) {
                $trailingContent = $nextCode;
            }
        }//end if

        if (T_ELSE === $tokens[$trailingContent]['code']) {
            if (T_IF === $tokens[$stackPtr]['code']) {
                // IF with ELSE.
                return;
            }
        }

        if (T_WHILE === $tokens[$trailingContent]['code']
            && T_DO === $tokens[$stackPtr]['code']
        ) {
            // DO with WHILE.
            return;
        }

        if (T_CLOSE_TAG === $tokens[$trailingContent]['code']) {
            // At the end of the script or embedded code.
            return;
        }

        if (true === isset($tokens[$trailingContent]['scope_condition'])
            && $tokens[$trailingContent]['scope_condition'] !== $trailingContent
            && true === isset($tokens[$trailingContent]['scope_opener'])
            && $tokens[$trailingContent]['scope_opener'] !== $trailingContent
        ) {
            // Another control structure's closing brace.
            $owner = $tokens[$trailingContent]['scope_condition'];
            if (T_FUNCTION === $tokens[$owner]['code']) {
                // The next content is the closing brace of a function
                // so normal function rules apply and we can ignore it.
                return;
            }

            if (T_CLOSURE === $tokens[$owner]['code']
                && (true === $phpcsFile->hasCondition($stackPtr, [T_FUNCTION, T_CLOSURE])
                || true === isset($tokens[$stackPtr]['nested_parenthesis']))
            ) {
                return;
            }

            if ($tokens[$trailingContent]['line'] !== ($tokens[$scopeCloser]['line'] + 1)) {
                $error = 'Blank line found after control structure';
                $fix = $phpcsFile->addFixableError($error, $scopeCloser, 'LineAfterClose');

                if (true === $fix) {
                    $phpcsFile->fixer->beginChangeset();
                    $i = ($scopeCloser + 1);
                    while ($tokens[$i]['line'] !== $tokens[$trailingContent]['line']) {
                        $phpcsFile->fixer->replaceToken($i, '');
                        ++$i;
                    }

                    $phpcsFile->fixer->addNewline($scopeCloser);
                    $phpcsFile->fixer->endChangeset();
                }
            }
        } elseif (T_ELSE !== $tokens[$trailingContent]['code']
            && T_ELSEIF !== $tokens[$trailingContent]['code']
            && T_CATCH !== $tokens[$trailingContent]['code']
            && T_FINALLY !== $tokens[$trailingContent]['code']
            && $tokens[$trailingContent]['line'] === ($tokens[$scopeCloser]['line'] + 1)
        ) {
            $error = 'No blank line found after control structure';
            $fix = $phpcsFile->addFixableError($error, $scopeCloser, 'NoLineAfterClose');
            if (true === $fix) {
                $trailingContent = $phpcsFile->findNext(
                    T_WHITESPACE,
                    ($scopeCloser + 1),
                    null,
                    true
                );

                if ((T_COMMENT === $tokens[$trailingContent]['code']
                    || true === isset(Tokens::$phpcsCommentTokens[$tokens[$trailingContent]['code']]))
                    && $tokens[$trailingContent]['line'] === $tokens[$scopeCloser]['line']
                ) {
                    $phpcsFile->fixer->addNewline($trailingContent);
                } else {
                    $phpcsFile->fixer->addNewline($scopeCloser);
                }
            }
        }//end if
    }

    //end process()
}//end class
