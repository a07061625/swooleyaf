<?php
/**
 * Checks that control structures have the correct spacing around brackets.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\PSR2\Sniffs\ControlStructures;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class ControlStructureSpacingSniff implements Sniff
{
    /**
     * How many spaces should follow the opening bracket.
     *
     * @var int
     */
    public $requiredSpacesAfterOpen = 0;

    /**
     * How many spaces should precede the closing bracket.
     *
     * @var int
     */
    public $requiredSpacesBeforeClose = 0;

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
            T_ELSE,
            T_ELSEIF,
            T_CATCH,
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
        $this->requiredSpacesAfterOpen = (int)$this->requiredSpacesAfterOpen;
        $this->requiredSpacesBeforeClose = (int)$this->requiredSpacesBeforeClose;
        $tokens = $phpcsFile->getTokens();

        if (false === isset($tokens[$stackPtr]['parenthesis_opener'])
            || false === isset($tokens[$stackPtr]['parenthesis_closer'])
        ) {
            return;
        }

        $parenOpener = $tokens[$stackPtr]['parenthesis_opener'];
        $parenCloser = $tokens[$stackPtr]['parenthesis_closer'];
        $nextContent = $phpcsFile->findNext(T_WHITESPACE, ($parenOpener + 1), null, true);
        if (false === \in_array($tokens[$nextContent]['code'], Tokens::$commentTokens, true)) {
            $spaceAfterOpen = 0;
            if (T_WHITESPACE === $tokens[($parenOpener + 1)]['code']) {
                if (false !== strpos($tokens[($parenOpener + 1)]['content'], $phpcsFile->eolChar)) {
                    $spaceAfterOpen = 'newline';
                } else {
                    $spaceAfterOpen = $tokens[($parenOpener + 1)]['length'];
                }
            }

            $phpcsFile->recordMetric($stackPtr, 'Spaces after control structure open parenthesis', $spaceAfterOpen);

            if ($spaceAfterOpen !== $this->requiredSpacesAfterOpen) {
                $error = 'Expected %s spaces after opening bracket; %s found';
                $data = [
                    $this->requiredSpacesAfterOpen,
                    $spaceAfterOpen,
                ];
                $fix = $phpcsFile->addFixableError($error, ($parenOpener + 1), 'SpacingAfterOpenBrace', $data);
                if (true === $fix) {
                    $padding = str_repeat(' ', $this->requiredSpacesAfterOpen);
                    if (0 === $spaceAfterOpen) {
                        $phpcsFile->fixer->addContent($parenOpener, $padding);
                    } elseif ('newline' === $spaceAfterOpen) {
                        $phpcsFile->fixer->replaceToken(($parenOpener + 1), '');
                    } else {
                        $phpcsFile->fixer->replaceToken(($parenOpener + 1), $padding);
                    }
                }
            }
        }//end if

        $prev = $phpcsFile->findPrevious(T_WHITESPACE, ($parenCloser - 1), $parenOpener, true);
        if ($tokens[$prev]['line'] === $tokens[$parenCloser]['line']) {
            $spaceBeforeClose = 0;
            if (T_WHITESPACE === $tokens[($parenCloser - 1)]['code']) {
                $spaceBeforeClose = \strlen(ltrim($tokens[($parenCloser - 1)]['content'], $phpcsFile->eolChar));
            }

            $phpcsFile->recordMetric($stackPtr, 'Spaces before control structure close parenthesis', $spaceBeforeClose);

            if ($spaceBeforeClose !== $this->requiredSpacesBeforeClose) {
                $error = 'Expected %s spaces before closing bracket; %s found';
                $data = [
                    $this->requiredSpacesBeforeClose,
                    $spaceBeforeClose,
                ];
                $fix = $phpcsFile->addFixableError($error, ($parenCloser - 1), 'SpaceBeforeCloseBrace', $data);
                if (true === $fix) {
                    $padding = str_repeat(' ', $this->requiredSpacesBeforeClose);
                    if (0 === $spaceBeforeClose) {
                        $phpcsFile->fixer->addContentBefore($parenCloser, $padding);
                    } else {
                        $phpcsFile->fixer->replaceToken(($parenCloser - 1), $padding);
                    }
                }
            }
        }//end if
    }

    //end process()
}//end class
