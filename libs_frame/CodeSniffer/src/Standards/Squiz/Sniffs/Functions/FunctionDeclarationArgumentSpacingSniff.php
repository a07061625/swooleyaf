<?php
/**
 * Checks that arguments in function declarations are spaced correctly.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\Functions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class FunctionDeclarationArgumentSpacingSniff implements Sniff
{
    /**
     * How many spaces should surround the equals signs.
     *
     * @var int
     */
    public $equalsSpacing = 0;

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
            T_FUNCTION,
            T_CLOSURE,
            T_FN,
        ];
    }

    //end register()

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (false === isset($tokens[$stackPtr]['parenthesis_opener'])
            || false === isset($tokens[$stackPtr]['parenthesis_closer'])
            || null === $tokens[$stackPtr]['parenthesis_opener']
            || null === $tokens[$stackPtr]['parenthesis_closer']
        ) {
            return;
        }

        $this->equalsSpacing = (int)$this->equalsSpacing;
        $this->requiredSpacesAfterOpen = (int)$this->requiredSpacesAfterOpen;
        $this->requiredSpacesBeforeClose = (int)$this->requiredSpacesBeforeClose;

        $this->processBracket($phpcsFile, $tokens[$stackPtr]['parenthesis_opener']);

        if (T_CLOSURE === $tokens[$stackPtr]['code']) {
            $use = $phpcsFile->findNext(T_USE, ($tokens[$stackPtr]['parenthesis_closer'] + 1), $tokens[$stackPtr]['scope_opener']);
            if (false !== $use) {
                $openBracket = $phpcsFile->findNext(T_OPEN_PARENTHESIS, ($use + 1), null);
                $this->processBracket($phpcsFile, $openBracket);
            }
        }
    }

    //end process()

    /**
     * Processes the contents of a single set of brackets.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile   The file being scanned.
     * @param int                         $openBracket The position of the open bracket
     *                                                 in the stack.
     */
    public function processBracket($phpcsFile, $openBracket)
    {
        $tokens = $phpcsFile->getTokens();
        $closeBracket = $tokens[$openBracket]['parenthesis_closer'];
        $multiLine = ($tokens[$openBracket]['line'] !== $tokens[$closeBracket]['line']);

        if (true === isset($tokens[$openBracket]['parenthesis_owner'])) {
            $stackPtr = $tokens[$openBracket]['parenthesis_owner'];
        } else {
            $stackPtr = $phpcsFile->findPrevious(T_USE, ($openBracket - 1));
        }

        $params = $phpcsFile->getMethodParameters($stackPtr);

        if (true === empty($params)) {
            // Check spacing around parenthesis.
            $next = $phpcsFile->findNext(T_WHITESPACE, ($openBracket + 1), $closeBracket, true);
            if (false === $next) {
                if (($closeBracket - $openBracket) !== 1) {
                    $error = 'Expected 0 spaces between parenthesis of function declaration; %s found';
                    $data = [$tokens[($openBracket + 1)]['length']];
                    $fix = $phpcsFile->addFixableError($error, $openBracket, 'SpacingBetween', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($openBracket + 1), '');
                    }
                }

                // No params, so we don't check normal spacing rules.
                return;
            }
        }

        foreach ($params as $paramNumber => $param) {
            if (true === $param['pass_by_reference']) {
                $refToken = $param['reference_token'];

                $gap = 0;
                if (T_WHITESPACE === $tokens[($refToken + 1)]['code']) {
                    $gap = $tokens[($refToken + 1)]['length'];
                }

                if (0 !== $gap) {
                    $error = 'Expected 0 spaces after reference operator for argument "%s"; %s found';
                    $data = [
                        $param['name'],
                        $gap,
                    ];
                    $fix = $phpcsFile->addFixableError($error, $refToken, 'SpacingAfterReference', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($refToken + 1), '');
                    }
                }
            }//end if

            if (true === $param['variable_length']) {
                $variadicToken = $param['variadic_token'];

                $gap = 0;
                if (T_WHITESPACE === $tokens[($variadicToken + 1)]['code']) {
                    $gap = $tokens[($variadicToken + 1)]['length'];
                }

                if (0 !== $gap) {
                    $error = 'Expected 0 spaces after variadic operator for argument "%s"; %s found';
                    $data = [
                        $param['name'],
                        $gap,
                    ];
                    $fix = $phpcsFile->addFixableError($error, $variadicToken, 'SpacingAfterVariadic', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($variadicToken + 1), '');
                    }
                }
            }//end if

            if (true === isset($param['default_equal_token'])) {
                $equalToken = $param['default_equal_token'];

                $spacesBefore = 0;
                if (($equalToken - $param['token']) > 1) {
                    $spacesBefore = $tokens[($param['token'] + 1)]['length'];
                }

                if ($spacesBefore !== $this->equalsSpacing) {
                    $error = 'Incorrect spacing between argument "%s" and equals sign; expected ' . $this->equalsSpacing . ' but found %s';
                    $data = [
                        $param['name'],
                        $spacesBefore,
                    ];

                    $fix = $phpcsFile->addFixableError($error, $equalToken, 'SpaceBeforeEquals', $data);
                    if (true === $fix) {
                        $padding = str_repeat(' ', $this->equalsSpacing);
                        if (0 === $spacesBefore) {
                            $phpcsFile->fixer->addContentBefore($equalToken, $padding);
                        } else {
                            $phpcsFile->fixer->replaceToken(($equalToken - 1), $padding);
                        }
                    }
                }//end if

                $spacesAfter = 0;
                if (T_WHITESPACE === $tokens[($equalToken + 1)]['code']) {
                    $spacesAfter = $tokens[($equalToken + 1)]['length'];
                }

                if ($spacesAfter !== $this->equalsSpacing) {
                    $error = 'Incorrect spacing between default value and equals sign for argument "%s"; expected ' . $this->equalsSpacing . ' but found %s';
                    $data = [
                        $param['name'],
                        $spacesAfter,
                    ];

                    $fix = $phpcsFile->addFixableError($error, $equalToken, 'SpaceAfterEquals', $data);
                    if (true === $fix) {
                        $padding = str_repeat(' ', $this->equalsSpacing);
                        if (0 === $spacesAfter) {
                            $phpcsFile->fixer->addContent($equalToken, $padding);
                        } else {
                            $phpcsFile->fixer->replaceToken(($equalToken + 1), $padding);
                        }
                    }
                }//end if
            }//end if

            if (false !== $param['type_hint_token']) {
                $typeHintToken = $param['type_hint_end_token'];

                $gap = 0;
                if (T_WHITESPACE === $tokens[($typeHintToken + 1)]['code']) {
                    $gap = $tokens[($typeHintToken + 1)]['length'];
                }

                if (1 !== $gap) {
                    $error = 'Expected 1 space between type hint and argument "%s"; %s found';
                    $data = [
                        $param['name'],
                        $gap,
                    ];
                    $fix = $phpcsFile->addFixableError($error, $typeHintToken, 'SpacingAfterHint', $data);
                    if (true === $fix) {
                        if (0 === $gap) {
                            $phpcsFile->fixer->addContent($typeHintToken, ' ');
                        } else {
                            $phpcsFile->fixer->replaceToken(($typeHintToken + 1), ' ');
                        }
                    }
                }
            }//end if

            $commaToken = false;
            if ($paramNumber > 0 && false !== $params[($paramNumber - 1)]['comma_token']) {
                $commaToken = $params[($paramNumber - 1)]['comma_token'];
            }

            if (false !== $commaToken) {
                if (T_WHITESPACE === $tokens[($commaToken - 1)]['code']) {
                    $error = 'Expected 0 spaces between argument "%s" and comma; %s found';
                    $data = [
                        $params[($paramNumber - 1)]['name'],
                        $tokens[($commaToken - 1)]['length'],
                    ];

                    $fix = $phpcsFile->addFixableError($error, $commaToken, 'SpaceBeforeComma', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($commaToken - 1), '');
                    }
                }

                // Don't check spacing after the comma if it is the last content on the line.
                $checkComma = true;
                if (true === $multiLine) {
                    $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($commaToken + 1), $closeBracket, true);
                    if ($tokens[$next]['line'] !== $tokens[$commaToken]['line']) {
                        $checkComma = false;
                    }
                }

                if (true === $checkComma) {
                    if (false === $param['type_hint_token']) {
                        $spacesAfter = 0;
                        if (T_WHITESPACE === $tokens[($commaToken + 1)]['code']) {
                            $spacesAfter = $tokens[($commaToken + 1)]['length'];
                        }

                        if (0 === $spacesAfter) {
                            $error = 'Expected 1 space between comma and argument "%s"; 0 found';
                            $data = [$param['name']];
                            $fix = $phpcsFile->addFixableError($error, $commaToken, 'NoSpaceBeforeArg', $data);
                            if (true === $fix) {
                                $phpcsFile->fixer->addContent($commaToken, ' ');
                            }
                        } elseif (1 !== $spacesAfter) {
                            $error = 'Expected 1 space between comma and argument "%s"; %s found';
                            $data = [
                                $param['name'],
                                $spacesAfter,
                            ];

                            $fix = $phpcsFile->addFixableError($error, $commaToken, 'SpacingBeforeArg', $data);
                            if (true === $fix) {
                                $phpcsFile->fixer->replaceToken(($commaToken + 1), ' ');
                            }
                        }//end if
                    } else {
                        $hint = $phpcsFile->getTokensAsString($param['type_hint_token'], (($param['type_hint_end_token'] - $param['type_hint_token']) + 1));
                        if (true === $param['nullable_type']) {
                            $hint = '?' . $hint;
                        }

                        if (T_WHITESPACE !== $tokens[($commaToken + 1)]['code']) {
                            $error = 'Expected 1 space between comma and type hint "%s"; 0 found';
                            $data = [$hint];
                            $fix = $phpcsFile->addFixableError($error, $commaToken, 'NoSpaceBeforeHint', $data);
                            if (true === $fix) {
                                $phpcsFile->fixer->addContent($commaToken, ' ');
                            }
                        } else {
                            $gap = $tokens[($commaToken + 1)]['length'];
                            if (1 !== $gap) {
                                $error = 'Expected 1 space between comma and type hint "%s"; %s found';
                                $data = [
                                    $hint,
                                    $gap,
                                ];
                                $fix = $phpcsFile->addFixableError($error, $commaToken, 'SpacingBeforeHint', $data);
                                if (true === $fix) {
                                    $phpcsFile->fixer->replaceToken(($commaToken + 1), ' ');
                                }
                            }
                        }//end if
                    }//end if
                }//end if
            }//end if
        }//end foreach

        // Only check spacing around parenthesis for single line definitions.
        if (true === $multiLine) {
            return;
        }

        $gap = 0;
        if (T_WHITESPACE === $tokens[($closeBracket - 1)]['code']) {
            $gap = $tokens[($closeBracket - 1)]['length'];
        }

        if ($gap !== $this->requiredSpacesBeforeClose) {
            $error = 'Expected %s spaces before closing parenthesis; %s found';
            $data = [
                $this->requiredSpacesBeforeClose,
                $gap,
            ];
            $fix = $phpcsFile->addFixableError($error, $closeBracket, 'SpacingBeforeClose', $data);
            if (true === $fix) {
                $padding = str_repeat(' ', $this->requiredSpacesBeforeClose);
                if (0 === $gap) {
                    $phpcsFile->fixer->addContentBefore($closeBracket, $padding);
                } else {
                    $phpcsFile->fixer->replaceToken(($closeBracket - 1), $padding);
                }
            }
        }

        $gap = 0;
        if (T_WHITESPACE === $tokens[($openBracket + 1)]['code']) {
            $gap = $tokens[($openBracket + 1)]['length'];
        }

        if ($gap !== $this->requiredSpacesAfterOpen) {
            $error = 'Expected %s spaces after opening parenthesis; %s found';
            $data = [
                $this->requiredSpacesAfterOpen,
                $gap,
            ];
            $fix = $phpcsFile->addFixableError($error, $openBracket, 'SpacingAfterOpen', $data);
            if (true === $fix) {
                $padding = str_repeat(' ', $this->requiredSpacesAfterOpen);
                if (0 === $gap) {
                    $phpcsFile->fixer->addContent($openBracket, $padding);
                } else {
                    $phpcsFile->fixer->replaceToken(($openBracket + 1), $padding);
                }
            }
        }
    }

    //end processBracket()
}//end class
