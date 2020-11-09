<?php
/**
 * Checks that the opening brace of a function is on the line after the function declaration.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\Functions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class OpeningFunctionBraceBsdAllmanSniff implements Sniff
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
     *
     * @return int[]
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

        if (0 === $lineDifference) {
            $error = 'Opening brace should be on a new line';
            $fix = $phpcsFile->addFixableError($error, $openingBrace, 'BraceOnSameLine');
            if (true === $fix) {
                $hasTrailingAnnotation = false;
                for ($nextLine = ($openingBrace + 1); $nextLine < $phpcsFile->numTokens; ++$nextLine) {
                    if ($tokens[$openingBrace]['line'] !== $tokens[$nextLine]['line']) {
                        break;
                    }

                    if (true === isset(Tokens::$phpcsCommentTokens[$tokens[$nextLine]['code']])) {
                        $hasTrailingAnnotation = true;
                    }
                }

                $phpcsFile->fixer->beginChangeset();
                $indent = $phpcsFile->findFirstOnLine([], $openingBrace);

                if (false === $hasTrailingAnnotation || false === $nextLine) {
                    if (T_WHITESPACE === $tokens[$indent]['code']) {
                        $phpcsFile->fixer->addContentBefore($openingBrace, $tokens[$indent]['content']);
                    }

                    if (T_WHITESPACE === $tokens[($openingBrace - 1)]['code']) {
                        $phpcsFile->fixer->replaceToken(($openingBrace - 1), '');
                    }

                    $phpcsFile->fixer->addNewlineBefore($openingBrace);
                } else {
                    $phpcsFile->fixer->replaceToken($openingBrace, '');
                    $phpcsFile->fixer->addNewlineBefore($nextLine);
                    $phpcsFile->fixer->addContentBefore($nextLine, '{');

                    if (T_WHITESPACE === $tokens[$indent]['code']) {
                        $phpcsFile->fixer->addContentBefore($nextLine, $tokens[$indent]['content']);
                    }
                }

                $phpcsFile->fixer->endChangeset();
            }//end if

            $phpcsFile->recordMetric($stackPtr, "{$metricType} opening brace placement", 'same line');
        } elseif ($lineDifference > 1) {
            $error = 'Opening brace should be on the line after the declaration; found %s blank line(s)';
            $data = [($lineDifference - 1)];
            $fix = $phpcsFile->addFixableError($error, $openingBrace, 'BraceSpacing', $data);
            if (true === $fix) {
                for ($i = ($tokens[$stackPtr]['parenthesis_closer'] + 1); $i < $openingBrace; ++$i) {
                    if ($tokens[$i]['line'] === $braceLine) {
                        $phpcsFile->fixer->addNewLineBefore($i);

                        break;
                    }

                    $phpcsFile->fixer->replaceToken($i, '');
                }
            }
        }//end if

        $ignore = Tokens::$phpcsCommentTokens;
        $ignore[] = T_WHITESPACE;
        $next = $phpcsFile->findNext($ignore, ($openingBrace + 1), null, true);
        if ($tokens[$next]['line'] === $tokens[$openingBrace]['line']) {
            if ($next === $tokens[$stackPtr]['scope_closer']) {
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
        if (1 !== $lineDifference) {
            return;
        }

        // We need to actually find the first piece of content on this line,
        // as if this is a method with tokens before it (public, static etc)
        // or an if with an else before it, then we need to start the scope
        // checking from there, rather than the current token.
        $lineStart = $phpcsFile->findFirstOnLine(T_WHITESPACE, $stackPtr, true);

        // The opening brace is on the correct line, now it needs to be
        // checked to be correctly indented.
        $startColumn = $tokens[$lineStart]['column'];
        $braceIndent = $tokens[$openingBrace]['column'];

        if ($braceIndent !== $startColumn) {
            $expected = ($startColumn - 1);
            $found = ($braceIndent - 1);

            $error = 'Opening brace indented incorrectly; expected %s spaces, found %s';
            $data = [
                $expected,
                $found,
            ];

            $fix = $phpcsFile->addFixableError($error, $openingBrace, 'BraceIndent', $data);
            if (true === $fix) {
                $indent = str_repeat(' ', $expected);
                if (0 === $found) {
                    $phpcsFile->fixer->addContentBefore($openingBrace, $indent);
                } else {
                    $phpcsFile->fixer->replaceToken(($openingBrace - 1), $indent);
                }
            }
        }//end if

        $phpcsFile->recordMetric($stackPtr, "{$metricType} opening brace placement", 'new line');
    }

    //end process()
}//end class
