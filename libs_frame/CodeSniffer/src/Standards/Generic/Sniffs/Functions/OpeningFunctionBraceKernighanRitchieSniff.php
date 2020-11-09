<?php
/**
 * Checks that the opening brace of a function is on the same line as the function declaration.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\Functions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class OpeningFunctionBraceKernighanRitchieSniff implements Sniff
{
    /**
     * Should this sniff check function braces?
     *
     * @var bool
     */
    public $checkFunctions = true;

    /**
     * Should this sniff check closure braces?
     *
     * @var bool
     */
    public $checkClosures = false;

    /**
     * Registers the tokens that this sniff wants to listen for.
     */
    public function register()
    {
        return [
            T_FUNCTION,
            T_CLOSURE,
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

        if (false === isset($tokens[$stackPtr]['scope_opener'])) {
            return;
        }

        if ((T_FUNCTION === $tokens[$stackPtr]['code']
            && false === (bool)$this->checkFunctions)
            || (T_CLOSURE === $tokens[$stackPtr]['code']
            && false === (bool)$this->checkClosures)
        ) {
            return;
        }

        $openingBrace = $tokens[$stackPtr]['scope_opener'];
        $closeBracket = $tokens[$stackPtr]['parenthesis_closer'];
        if (T_CLOSURE === $tokens[$stackPtr]['code']) {
            $use = $phpcsFile->findNext(T_USE, ($closeBracket + 1), $tokens[$stackPtr]['scope_opener']);
            if (false !== $use) {
                $openBracket = $phpcsFile->findNext(T_OPEN_PARENTHESIS, ($use + 1));
                $closeBracket = $tokens[$openBracket]['parenthesis_closer'];
            }
        }

        // Find the end of the function declaration.
        $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($openingBrace - 1), $closeBracket, true);

        $functionLine = $tokens[$prev]['line'];
        $braceLine = $tokens[$openingBrace]['line'];

        $lineDifference = ($braceLine - $functionLine);

        $metricType = 'Function';
        if (T_CLOSURE === $tokens[$stackPtr]['code']) {
            $metricType = 'Closure';
        }

        if ($lineDifference > 0) {
            $phpcsFile->recordMetric($stackPtr, "{$metricType} opening brace placement", 'new line');
            $error = 'Opening brace should be on the same line as the declaration';
            $fix = $phpcsFile->addFixableError($error, $openingBrace, 'BraceOnNewLine');
            if (true === $fix) {
                $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($openingBrace - 1), $closeBracket, true);
                $phpcsFile->fixer->beginChangeset();
                $phpcsFile->fixer->addContent($prev, ' {');
                $phpcsFile->fixer->replaceToken($openingBrace, '');
                if (T_WHITESPACE === $tokens[($openingBrace + 1)]['code']
                    && $tokens[($openingBrace + 2)]['line'] > $tokens[$openingBrace]['line']
                ) {
                    // Brace is followed by a new line, so remove it to ensure we don't
                    // leave behind a blank line at the top of the block.
                    $phpcsFile->fixer->replaceToken(($openingBrace + 1), '');

                    if (T_WHITESPACE === $tokens[($openingBrace - 1)]['code']
                        && $tokens[($openingBrace - 1)]['line'] === $tokens[$openingBrace]['line']
                        && $tokens[($openingBrace - 2)]['line'] < $tokens[$openingBrace]['line']
                    ) {
                        // Brace is preceded by indent, so remove it to ensure we don't
                        // leave behind more indent than is required for the first line.
                        $phpcsFile->fixer->replaceToken(($openingBrace - 1), '');
                    }
                }

                $phpcsFile->fixer->endChangeset();
            }//end if
        } else {
            $phpcsFile->recordMetric($stackPtr, "{$metricType} opening brace placement", 'same line');
        }//end if

        $ignore = Tokens::$phpcsCommentTokens;
        $ignore[] = T_WHITESPACE;
        $next = $phpcsFile->findNext($ignore, ($openingBrace + 1), null, true);
        if ($tokens[$next]['line'] === $tokens[$openingBrace]['line']) {
            if ($next === $tokens[$stackPtr]['scope_closer']
                || T_CLOSE_TAG === $tokens[$next]['code']
            ) {
                // Ignore empty functions.
                return;
            }

            $error = 'Opening brace must be the last content on the line';
            $fix = $phpcsFile->addFixableError($error, $openingBrace, 'ContentAfterBrace');
            if (true === $fix) {
                $phpcsFile->fixer->addNewline($openingBrace);
            }
        }

        // Only continue checking if the opening brace looks good.
        if ($lineDifference > 0) {
            return;
        }

        // We are looking for tabs, even if they have been replaced, because
        // we enforce a space here.
        if (true === isset($tokens[($openingBrace - 1)]['orig_content'])) {
            $spacing = $tokens[($openingBrace - 1)]['orig_content'];
        } else {
            $spacing = $tokens[($openingBrace - 1)]['content'];
        }

        if (T_WHITESPACE !== $tokens[($openingBrace - 1)]['code']) {
            $length = 0;
        } elseif ("\t" === $spacing) {
            $length = '\t';
        } else {
            $length = \strlen($spacing);
        }

        if (1 !== $length) {
            $error = 'Expected 1 space before opening brace; found %s';
            $data = [$length];
            $fix = $phpcsFile->addFixableError($error, $closeBracket, 'SpaceBeforeBrace', $data);
            if (true === $fix) {
                if (0 === $length || '\t' === $length) {
                    $phpcsFile->fixer->addContentBefore($openingBrace, ' ');
                } else {
                    $phpcsFile->fixer->replaceToken(($openingBrace - 1), ' ');
                }
            }
        }
    }

    //end process()
}//end class
