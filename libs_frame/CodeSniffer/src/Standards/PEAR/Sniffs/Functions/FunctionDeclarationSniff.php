<?php
/**
 * Ensure single and multi-line function declarations are defined correctly.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\PEAR\Sniffs\Functions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Functions\OpeningFunctionBraceBsdAllmanSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Functions\OpeningFunctionBraceKernighanRitchieSniff;
use PHP_CodeSniffer\Util\Tokens;

class FunctionDeclarationSniff implements Sniff
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
     * The number of spaces code should be indented.
     *
     * @var int
     */
    public $indent = 4;

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

        if (false === isset($tokens[$stackPtr]['parenthesis_opener'])
            || false === isset($tokens[$stackPtr]['parenthesis_closer'])
            || null === $tokens[$stackPtr]['parenthesis_opener']
            || null === $tokens[$stackPtr]['parenthesis_closer']
        ) {
            return;
        }

        $openBracket = $tokens[$stackPtr]['parenthesis_opener'];
        $closeBracket = $tokens[$stackPtr]['parenthesis_closer'];

        if ('function' === strtolower($tokens[$stackPtr]['content'])) {
            // Must be one space after the FUNCTION keyword.
            if ($tokens[($stackPtr + 1)]['content'] === $phpcsFile->eolChar) {
                $spaces = 'newline';
            } elseif (T_WHITESPACE === $tokens[($stackPtr + 1)]['code']) {
                $spaces = $tokens[($stackPtr + 1)]['length'];
            } else {
                $spaces = 0;
            }

            if (1 !== $spaces) {
                $error = 'Expected 1 space after FUNCTION keyword; %s found';
                $data = [$spaces];
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpaceAfterFunction', $data);
                if (true === $fix) {
                    if (0 === $spaces) {
                        $phpcsFile->fixer->addContent($stackPtr, ' ');
                    } else {
                        $phpcsFile->fixer->replaceToken(($stackPtr + 1), ' ');
                    }
                }
            }
        }//end if

        // Must be no space before the opening parenthesis. For closures, this is
        // enforced by the previous check because there is no content between the keywords
        // and the opening parenthesis.
        // Unfinished closures are tokenized as T_FUNCTION however, and can be excluded
        // by checking for the scope_opener.
        if (T_FUNCTION === $tokens[$stackPtr]['code']
            && (true === isset($tokens[$stackPtr]['scope_opener']) || false === $phpcsFile->getMethodProperties($stackPtr)['has_body'])
        ) {
            if ($tokens[($openBracket - 1)]['content'] === $phpcsFile->eolChar) {
                $spaces = 'newline';
            } elseif (T_WHITESPACE === $tokens[($openBracket - 1)]['code']) {
                $spaces = $tokens[($openBracket - 1)]['length'];
            } else {
                $spaces = 0;
            }

            if (0 !== $spaces) {
                $error = 'Expected 0 spaces before opening parenthesis; %s found';
                $data = [$spaces];
                $fix = $phpcsFile->addFixableError($error, $openBracket, 'SpaceBeforeOpenParen', $data);
                if (true === $fix) {
                    $phpcsFile->fixer->replaceToken(($openBracket - 1), '');
                }
            }

            // Must be no space before semicolon in abstract/interface methods.
            if (false === $phpcsFile->getMethodProperties($stackPtr)['has_body']) {
                $end = $phpcsFile->findNext(T_SEMICOLON, $closeBracket);
                if ($tokens[($end - 1)]['content'] === $phpcsFile->eolChar) {
                    $spaces = 'newline';
                } elseif (T_WHITESPACE === $tokens[($end - 1)]['code']) {
                    $spaces = $tokens[($end - 1)]['length'];
                } else {
                    $spaces = 0;
                }

                if (0 !== $spaces) {
                    $error = 'Expected 0 spaces before semicolon; %s found';
                    $data = [$spaces];
                    $fix = $phpcsFile->addFixableError($error, $end, 'SpaceBeforeSemicolon', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($end - 1), '');
                    }
                }
            }
        }//end if

        // Must be one space before and after USE keyword for closures.
        if (T_CLOSURE === $tokens[$stackPtr]['code']) {
            $use = $phpcsFile->findNext(T_USE, ($closeBracket + 1), $tokens[$stackPtr]['scope_opener']);
            if (false !== $use) {
                if (T_WHITESPACE !== $tokens[($use + 1)]['code']) {
                    $length = 0;
                } elseif ("\t" === $tokens[($use + 1)]['content']) {
                    $length = '\t';
                } else {
                    $length = $tokens[($use + 1)]['length'];
                }

                if (1 !== $length) {
                    $error = 'Expected 1 space after USE keyword; found %s';
                    $data = [$length];
                    $fix = $phpcsFile->addFixableError($error, $use, 'SpaceAfterUse', $data);
                    if (true === $fix) {
                        if (0 === $length) {
                            $phpcsFile->fixer->addContent($use, ' ');
                        } else {
                            $phpcsFile->fixer->replaceToken(($use + 1), ' ');
                        }
                    }
                }

                if (T_WHITESPACE !== $tokens[($use - 1)]['code']) {
                    $length = 0;
                } elseif ("\t" === $tokens[($use - 1)]['content']) {
                    $length = '\t';
                } else {
                    $length = $tokens[($use - 1)]['length'];
                }

                if (1 !== $length) {
                    $error = 'Expected 1 space before USE keyword; found %s';
                    $data = [$length];
                    $fix = $phpcsFile->addFixableError($error, $use, 'SpaceBeforeUse', $data);
                    if (true === $fix) {
                        if (0 === $length) {
                            $phpcsFile->fixer->addContentBefore($use, ' ');
                        } else {
                            $phpcsFile->fixer->replaceToken(($use - 1), ' ');
                        }
                    }
                }
            }//end if
        }//end if

        if (true === $this->isMultiLineDeclaration($phpcsFile, $stackPtr, $openBracket, $tokens)) {
            $this->processMultiLineDeclaration($phpcsFile, $stackPtr, $tokens);
        } else {
            $this->processSingleLineDeclaration($phpcsFile, $stackPtr, $tokens);
        }
    }

    //end process()

    /**
     * Determine if this is a multi-line function declaration.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile   The file being scanned.
     * @param int                         $stackPtr    The position of the current token
     *                                                 in the stack passed in $tokens.
     * @param int                         $openBracket The position of the opening bracket
     *                                                 in the stack passed in $tokens.
     * @param array                       $tokens      The stack of tokens that make up
     *                                                 the file.
     *
     * @return bool
     */
    public function isMultiLineDeclaration($phpcsFile, $stackPtr, $openBracket, $tokens)
    {
        $closeBracket = $tokens[$openBracket]['parenthesis_closer'];
        if ($tokens[$openBracket]['line'] !== $tokens[$closeBracket]['line']) {
            return true;
        }

        // Closures may use the USE keyword and so be multi-line in this way.
        if (T_CLOSURE === $tokens[$stackPtr]['code']) {
            $use = $phpcsFile->findNext(T_USE, ($closeBracket + 1), $tokens[$stackPtr]['scope_opener']);
            if (false !== $use) {
                // If the opening and closing parenthesis of the use statement
                // are also on the same line, this is a single line declaration.
                $open = $phpcsFile->findNext(T_OPEN_PARENTHESIS, ($use + 1));
                $close = $tokens[$open]['parenthesis_closer'];
                if ($tokens[$open]['line'] !== $tokens[$close]['line']) {
                    return true;
                }
            }
        }

        return false;
    }

    //end isMultiLineDeclaration()

    /**
     * Processes single-line declarations.
     *
     * Just uses the Generic BSD-Allman brace sniff.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     * @param array                       $tokens    The stack of tokens that make up
     *                                               the file.
     */
    public function processSingleLineDeclaration($phpcsFile, $stackPtr, $tokens)
    {
        if (T_CLOSURE === $tokens[$stackPtr]['code']) {
            $sniff = new OpeningFunctionBraceKernighanRitchieSniff();
        } else {
            $sniff = new OpeningFunctionBraceBsdAllmanSniff();
        }

        $sniff->checkClosures = true;
        $sniff->process($phpcsFile, $stackPtr);
    }

    //end processSingleLineDeclaration()

    /**
     * Processes multi-line declarations.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     * @param array                       $tokens    The stack of tokens that make up
     *                                               the file.
     */
    public function processMultiLineDeclaration($phpcsFile, $stackPtr, $tokens)
    {
        $this->processArgumentList($phpcsFile, $stackPtr, $this->indent);

        $closeBracket = $tokens[$stackPtr]['parenthesis_closer'];
        if (T_CLOSURE === $tokens[$stackPtr]['code']) {
            $use = $phpcsFile->findNext(T_USE, ($closeBracket + 1), $tokens[$stackPtr]['scope_opener']);
            if (false !== $use) {
                $open = $phpcsFile->findNext(T_OPEN_PARENTHESIS, ($use + 1));
                $closeBracket = $tokens[$open]['parenthesis_closer'];
            }
        }

        if (false === isset($tokens[$stackPtr]['scope_opener'])) {
            return;
        }

        // The opening brace needs to be one space away from the closing parenthesis.
        $opener = $tokens[$stackPtr]['scope_opener'];
        if ($tokens[$opener]['line'] !== $tokens[$closeBracket]['line']) {
            $error = 'The closing parenthesis and the opening brace of a multi-line function declaration must be on the same line';
            $fix = $phpcsFile->addFixableError($error, $opener, 'NewlineBeforeOpenBrace');
            if (true === $fix) {
                $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($opener - 1), $closeBracket, true);
                $phpcsFile->fixer->beginChangeset();
                $phpcsFile->fixer->addContent($prev, ' {');

                // If the opener is on a line by itself, removing it will create
                // an empty line, so just remove the entire line instead.
                $prev = $phpcsFile->findPrevious(T_WHITESPACE, ($opener - 1), $closeBracket, true);
                $next = $phpcsFile->findNext(T_WHITESPACE, ($opener + 1), null, true);

                if ($tokens[$prev]['line'] < $tokens[$opener]['line']
                    && $tokens[$next]['line'] > $tokens[$opener]['line']
                ) {
                    // Clear the whole line.
                    for ($i = ($prev + 1); $i < $next; ++$i) {
                        if ($tokens[$i]['line'] === $tokens[$opener]['line']) {
                            $phpcsFile->fixer->replaceToken($i, '');
                        }
                    }
                } else {
                    // Just remove the opener.
                    $phpcsFile->fixer->replaceToken($opener, '');
                    if ($tokens[$next]['line'] === $tokens[$opener]['line']) {
                        $phpcsFile->fixer->replaceToken(($opener + 1), '');
                    }
                }

                $phpcsFile->fixer->endChangeset();
            }//end if
        } else {
            $prev = $tokens[($opener - 1)];
            if (T_WHITESPACE !== $prev['code']) {
                $length = 0;
            } else {
                $length = \strlen($prev['content']);
            }

            if (1 !== $length) {
                $error = 'There must be a single space between the closing parenthesis and the opening brace of a multi-line function declaration; found %s spaces';
                $fix = $phpcsFile->addFixableError($error, ($opener - 1), 'SpaceBeforeOpenBrace', [$length]);
                if (true === $fix) {
                    if (0 === $length) {
                        $phpcsFile->fixer->addContentBefore($opener, ' ');
                    } else {
                        $phpcsFile->fixer->replaceToken(($opener - 1), ' ');
                    }
                }

                return;
            }//end if
        }//end if
    }

    //end processMultiLineDeclaration()

    /**
     * Processes multi-line argument list declarations.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     * @param int                         $indent    The number of spaces code should be indented.
     * @param string                      $type      The type of the token the brackets
     *                                               belong to.
     */
    public function processArgumentList($phpcsFile, $stackPtr, $indent, $type = 'function')
    {
        $tokens = $phpcsFile->getTokens();

        // We need to work out how far indented the function
        // declaration itself is, so we can work out how far to
        // indent parameters.
        $functionIndent = 0;
        for ($i = ($stackPtr - 1); $i >= 0; --$i) {
            if ($tokens[$i]['line'] !== $tokens[$stackPtr]['line']) {
                break;
            }
        }

        // Move $i back to the line the function is or to 0.
        ++$i;

        if (T_WHITESPACE === $tokens[$i]['code']) {
            $functionIndent = $tokens[$i]['length'];
        }

        // The closing parenthesis must be on a new line, even
        // when checking abstract function definitions.
        $closeBracket = $tokens[$stackPtr]['parenthesis_closer'];
        $prev = $phpcsFile->findPrevious(
            T_WHITESPACE,
            ($closeBracket - 1),
            null,
            true
        );

        if ($tokens[$closeBracket]['line'] !== $tokens[$tokens[$closeBracket]['parenthesis_opener']]['line']
            && $tokens[$prev]['line'] === $tokens[$closeBracket]['line']
        ) {
            $error = 'The closing parenthesis of a multi-line ' . $type . ' declaration must be on a new line';
            $fix = $phpcsFile->addFixableError($error, $closeBracket, 'CloseBracketLine');
            if (true === $fix) {
                $phpcsFile->fixer->addNewlineBefore($closeBracket);
            }
        }

        // If this is a closure and is using a USE statement, the closing
        // parenthesis we need to look at from now on is the closing parenthesis
        // of the USE statement.
        if (T_CLOSURE === $tokens[$stackPtr]['code']) {
            $use = $phpcsFile->findNext(T_USE, ($closeBracket + 1), $tokens[$stackPtr]['scope_opener']);
            if (false !== $use) {
                $open = $phpcsFile->findNext(T_OPEN_PARENTHESIS, ($use + 1));
                $closeBracket = $tokens[$open]['parenthesis_closer'];

                $prev = $phpcsFile->findPrevious(
                    T_WHITESPACE,
                    ($closeBracket - 1),
                    null,
                    true
                );

                if ($tokens[$closeBracket]['line'] !== $tokens[$tokens[$closeBracket]['parenthesis_opener']]['line']
                    && $tokens[$prev]['line'] === $tokens[$closeBracket]['line']
                ) {
                    $error = 'The closing parenthesis of a multi-line use declaration must be on a new line';
                    $fix = $phpcsFile->addFixableError($error, $closeBracket, 'UseCloseBracketLine');
                    if (true === $fix) {
                        $phpcsFile->fixer->addNewlineBefore($closeBracket);
                    }
                }
            }//end if
        }//end if

        // Each line between the parenthesis should be indented 4 spaces.
        $openBracket = $tokens[$stackPtr]['parenthesis_opener'];
        $lastLine = $tokens[$openBracket]['line'];
        for ($i = ($openBracket + 1); $i < $closeBracket; ++$i) {
            if ($tokens[$i]['line'] !== $lastLine) {
                if ($i === $tokens[$stackPtr]['parenthesis_closer']
                    || (T_WHITESPACE === $tokens[$i]['code']
                    && (($i + 1) === $closeBracket
                    || ($i + 1) === $tokens[$stackPtr]['parenthesis_closer']))
                ) {
                    // Closing braces need to be indented to the same level
                    // as the function.
                    $expectedIndent = $functionIndent;
                } else {
                    $expectedIndent = ($functionIndent + $indent);
                }

                // We changed lines, so this should be a whitespace indent token.
                if (T_WHITESPACE !== $tokens[$i]['code']) {
                    $foundIndent = 0;
                } elseif ($tokens[$i]['line'] !== $tokens[($i + 1)]['line']) {
                    // This is an empty line, so don't check the indent.
                    $foundIndent = $expectedIndent;

                    $error = 'Blank lines are not allowed in a multi-line ' . $type . ' declaration';
                    $fix = $phpcsFile->addFixableError($error, $i, 'EmptyLine');
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken($i, '');
                    }
                } else {
                    $foundIndent = $tokens[$i]['length'];
                }

                if ($expectedIndent !== $foundIndent) {
                    $error = 'Multi-line ' . $type . ' declaration not indented correctly; expected %s spaces but found %s';
                    $data = [
                        $expectedIndent,
                        $foundIndent,
                    ];

                    $fix = $phpcsFile->addFixableError($error, $i, 'Indent', $data);
                    if (true === $fix) {
                        $spaces = str_repeat(' ', $expectedIndent);
                        if (0 === $foundIndent) {
                            $phpcsFile->fixer->addContentBefore($i, $spaces);
                        } else {
                            $phpcsFile->fixer->replaceToken($i, $spaces);
                        }
                    }
                }

                $lastLine = $tokens[$i]['line'];
            }//end if

            if (T_ARRAY === $tokens[$i]['code'] || T_OPEN_SHORT_ARRAY === $tokens[$i]['code']) {
                // Skip arrays as they have their own indentation rules.
                if (T_OPEN_SHORT_ARRAY === $tokens[$i]['code']) {
                    $i = $tokens[$i]['bracket_closer'];
                } else {
                    $i = $tokens[$i]['parenthesis_closer'];
                }

                $lastLine = $tokens[$i]['line'];

                continue;
            }
        }//end for
    }

    //end processArgumentList()
}//end class
