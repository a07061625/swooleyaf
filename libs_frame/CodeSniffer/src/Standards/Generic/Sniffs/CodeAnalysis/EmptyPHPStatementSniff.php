<?php
/**
 * Checks against empty PHP statements.
 *
 * - Check against two semi-colons with no executable code in between.
 * - Check against an empty PHP open - close tag combination.
 *
 * @author    Juliette Reinders Folmer <phpcs_nospam@adviesenzo.nl>
 * @copyright 2017 Juliette Reinders Folmer. All rights reserved.
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class EmptyPHPStatementSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return int[]
     */
    public function register()
    {
        return [
            T_SEMICOLON,
            T_CLOSE_TAG,
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

        switch ($tokens[$stackPtr]['type']) {
        // Detect `something();;`.
        case 'T_SEMICOLON':
            $prevNonEmpty = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);

            if (false === $prevNonEmpty) {
                return;
            }

            if (T_SEMICOLON !== $tokens[$prevNonEmpty]['code']
                && T_OPEN_TAG !== $tokens[$prevNonEmpty]['code']
                && T_OPEN_TAG_WITH_ECHO !== $tokens[$prevNonEmpty]['code']
            ) {
                if (false === isset($tokens[$prevNonEmpty]['scope_condition'])) {
                    return;
                }

                if ($tokens[$prevNonEmpty]['scope_opener'] !== $prevNonEmpty
                    && T_CLOSE_CURLY_BRACKET !== $tokens[$prevNonEmpty]['code']
                ) {
                    return;
                }

                $scopeOwner = $tokens[$tokens[$prevNonEmpty]['scope_condition']]['code'];
                if (T_CLOSURE === $scopeOwner || T_ANON_CLASS === $scopeOwner) {
                    return;
                }

                // Else, it's something like `if (foo) {};` and the semi-colon is not needed.
            }

            if (true === isset($tokens[$stackPtr]['nested_parenthesis'])) {
                $nested = $tokens[$stackPtr]['nested_parenthesis'];
                $lastCloser = array_pop($nested);
                if (true === isset($tokens[$lastCloser]['parenthesis_owner'])
                    && T_FOR === $tokens[$tokens[$lastCloser]['parenthesis_owner']]['code']
                ) {
                    // Empty for() condition.
                    return;
                }
            }

            $fix = $phpcsFile->addFixableWarning(
                'Empty PHP statement detected: superfluous semi-colon.',
                $stackPtr,
                'SemicolonWithoutCodeDetected'
            );
            if (true === $fix) {
                $phpcsFile->fixer->beginChangeset();

                if (T_OPEN_TAG === $tokens[$prevNonEmpty]['code']
                    || T_OPEN_TAG_WITH_ECHO === $tokens[$prevNonEmpty]['code']
                ) {
                    // Check for superfluous whitespace after the semi-colon which will be
                    // removed as the `<?php ` open tag token already contains whitespace,
                    // either a space or a new line.
                    if (T_WHITESPACE === $tokens[($stackPtr + 1)]['code']) {
                        $replacement = str_replace(' ', '', $tokens[($stackPtr + 1)]['content']);
                        $phpcsFile->fixer->replaceToken(($stackPtr + 1), $replacement);
                    }
                }

                for ($i = $stackPtr; $i > $prevNonEmpty; --$i) {
                    if (T_SEMICOLON !== $tokens[$i]['code']
                        && T_WHITESPACE !== $tokens[$i]['code']
                    ) {
                        break;
                    }

                    $phpcsFile->fixer->replaceToken($i, '');
                }

                $phpcsFile->fixer->endChangeset();
            }//end if

            break;
        // Detect `<?php ? >`.
        case 'T_CLOSE_TAG':
            $prevNonEmpty = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);

            if (false === $prevNonEmpty
                || (T_OPEN_TAG !== $tokens[$prevNonEmpty]['code']
                && T_OPEN_TAG_WITH_ECHO !== $tokens[$prevNonEmpty]['code'])
            ) {
                return;
            }

            $fix = $phpcsFile->addFixableWarning(
                'Empty PHP open/close tag combination detected.',
                $prevNonEmpty,
                'EmptyPHPOpenCloseTagsDetected'
            );
            if (true === $fix) {
                $phpcsFile->fixer->beginChangeset();

                for ($i = $prevNonEmpty; $i <= $stackPtr; ++$i) {
                    $phpcsFile->fixer->replaceToken($i, '');
                }

                $phpcsFile->fixer->endChangeset();
            }

            break;
        default:
            // Deliberately left empty.
            break;
        }//end switch
    }

    //end process()
}//end class
