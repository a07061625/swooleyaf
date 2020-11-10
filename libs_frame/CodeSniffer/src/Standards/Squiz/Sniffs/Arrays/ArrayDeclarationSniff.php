<?php
/**
 * Ensures that arrays conform to the array coding standard.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class ArrayDeclarationSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_ARRAY,
            T_OPEN_SHORT_ARRAY,
        ];
    }

    //end register()

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The current file being checked.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (T_ARRAY === $tokens[$stackPtr]['code']) {
            $phpcsFile->recordMetric($stackPtr, 'Short array syntax used', 'no');

            // Array keyword should be lower case.
            if ($tokens[$stackPtr]['content'] !== strtolower($tokens[$stackPtr]['content'])) {
                if ($tokens[$stackPtr]['content'] === strtoupper($tokens[$stackPtr]['content'])) {
                    $phpcsFile->recordMetric($stackPtr, 'Array keyword case', 'upper');
                } else {
                    $phpcsFile->recordMetric($stackPtr, 'Array keyword case', 'mixed');
                }

                $error = 'Array keyword should be lower case; expected "array" but found "%s"';
                $data = [$tokens[$stackPtr]['content']];
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NotLowerCase', $data);
                if (true === $fix) {
                    $phpcsFile->fixer->replaceToken($stackPtr, 'array');
                }
            } else {
                $phpcsFile->recordMetric($stackPtr, 'Array keyword case', 'lower');
            }

            $arrayStart = $tokens[$stackPtr]['parenthesis_opener'];
            if (false === isset($tokens[$arrayStart]['parenthesis_closer'])) {
                return;
            }

            $arrayEnd = $tokens[$arrayStart]['parenthesis_closer'];

            if ($arrayStart !== ($stackPtr + 1)) {
                $error = 'There must be no space between the "array" keyword and the opening parenthesis';

                $next = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), $arrayStart, true);
                if (true === isset(Tokens::$commentTokens[$tokens[$next]['code']])) {
                    // We don't have anywhere to put the comment, so don't attempt to fix it.
                    $phpcsFile->addError($error, $stackPtr, 'SpaceAfterKeyword');
                } else {
                    $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpaceAfterKeyword');
                    if (true === $fix) {
                        $phpcsFile->fixer->beginChangeset();
                        for ($i = ($stackPtr + 1); $i < $arrayStart; ++$i) {
                            $phpcsFile->fixer->replaceToken($i, '');
                        }

                        $phpcsFile->fixer->endChangeset();
                    }
                }
            }
        } else {
            $phpcsFile->recordMetric($stackPtr, 'Short array syntax used', 'yes');
            $arrayStart = $stackPtr;
            $arrayEnd = $tokens[$stackPtr]['bracket_closer'];
        }//end if

        // Check for empty arrays.
        $content = $phpcsFile->findNext(T_WHITESPACE, ($arrayStart + 1), ($arrayEnd + 1), true);
        if ($content === $arrayEnd) {
            // Empty array, but if the brackets aren't together, there's a problem.
            if (($arrayEnd - $arrayStart) !== 1) {
                $error = 'Empty array declaration must have no space between the parentheses';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpaceInEmptyArray');

                if (true === $fix) {
                    $phpcsFile->fixer->beginChangeset();
                    for ($i = ($arrayStart + 1); $i < $arrayEnd; ++$i) {
                        $phpcsFile->fixer->replaceToken($i, '');
                    }

                    $phpcsFile->fixer->endChangeset();
                }
            }

            // We can return here because there is nothing else to check. All code
            // below can assume that the array is not empty.
            return;
        }

        if ($tokens[$arrayStart]['line'] === $tokens[$arrayEnd]['line']) {
            $this->processSingleLineArray($phpcsFile, $stackPtr, $arrayStart, $arrayEnd);
        } else {
            $this->processMultiLineArray($phpcsFile, $stackPtr, $arrayStart, $arrayEnd);
        }
    }

    //end process()

    /**
     * Processes a single-line array definition.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile  The current file being checked.
     * @param int                         $stackPtr   The position of the current token
     *                                                in the stack passed in $tokens.
     * @param int                         $arrayStart The token that starts the array definition.
     * @param int                         $arrayEnd   The token that ends the array definition.
     */
    public function processSingleLineArray($phpcsFile, $stackPtr, $arrayStart, $arrayEnd)
    {
        $tokens = $phpcsFile->getTokens();

        // Check if there are multiple values. If so, then it has to be multiple lines
        // unless it is contained inside a function call or condition.
        $valueCount = 0;
        $commas = [];
        for ($i = ($arrayStart + 1); $i < $arrayEnd; ++$i) {
            // Skip bracketed statements, like function calls.
            if (T_OPEN_PARENTHESIS === $tokens[$i]['code']) {
                $i = $tokens[$i]['parenthesis_closer'];

                continue;
            }

            if (T_COMMA === $tokens[$i]['code']) {
                // Before counting this comma, make sure we are not
                // at the end of the array.
                $next = $phpcsFile->findNext(T_WHITESPACE, ($i + 1), $arrayEnd, true);
                if (false !== $next) {
                    ++$valueCount;
                    $commas[] = $i;
                } else {
                    // There is a comma at the end of a single line array.
                    $error = 'Comma not allowed after last value in single-line array declaration';
                    $fix = $phpcsFile->addFixableError($error, $i, 'CommaAfterLast');
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken($i, '');
                    }
                }
            }
        }//end for

        // Now check each of the double arrows (if any).
        $nextArrow = $arrayStart;
        while (($nextArrow = $phpcsFile->findNext(T_DOUBLE_ARROW, ($nextArrow + 1), $arrayEnd)) !== false) {
            if (T_WHITESPACE !== $tokens[($nextArrow - 1)]['code']) {
                $content = $tokens[($nextArrow - 1)]['content'];
                $error = 'Expected 1 space between "%s" and double arrow; 0 found';
                $data = [$content];
                $fix = $phpcsFile->addFixableError($error, $nextArrow, 'NoSpaceBeforeDoubleArrow', $data);
                if (true === $fix) {
                    $phpcsFile->fixer->addContentBefore($nextArrow, ' ');
                }
            } else {
                $spaceLength = $tokens[($nextArrow - 1)]['length'];
                if (1 !== $spaceLength) {
                    $content = $tokens[($nextArrow - 2)]['content'];
                    $error = 'Expected 1 space between "%s" and double arrow; %s found';
                    $data = [
                        $content,
                        $spaceLength,
                    ];

                    $fix = $phpcsFile->addFixableError($error, $nextArrow, 'SpaceBeforeDoubleArrow', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($nextArrow - 1), ' ');
                    }
                }
            }//end if

            if (T_WHITESPACE !== $tokens[($nextArrow + 1)]['code']) {
                $content = $tokens[($nextArrow + 1)]['content'];
                $error = 'Expected 1 space between double arrow and "%s"; 0 found';
                $data = [$content];
                $fix = $phpcsFile->addFixableError($error, $nextArrow, 'NoSpaceAfterDoubleArrow', $data);
                if (true === $fix) {
                    $phpcsFile->fixer->addContent($nextArrow, ' ');
                }
            } else {
                $spaceLength = $tokens[($nextArrow + 1)]['length'];
                if (1 !== $spaceLength) {
                    $content = $tokens[($nextArrow + 2)]['content'];
                    $error = 'Expected 1 space between double arrow and "%s"; %s found';
                    $data = [
                        $content,
                        $spaceLength,
                    ];

                    $fix = $phpcsFile->addFixableError($error, $nextArrow, 'SpaceAfterDoubleArrow', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($nextArrow + 1), ' ');
                    }
                }
            }//end if
        }//end while

        if ($valueCount > 0) {
            $nestedParenthesis = false;
            if (true === isset($tokens[$stackPtr]['nested_parenthesis'])) {
                $nested = $tokens[$stackPtr]['nested_parenthesis'];
                $nestedParenthesis = array_pop($nested);
            }

            if (false === $nestedParenthesis
                || $tokens[$nestedParenthesis]['line'] !== $tokens[$stackPtr]['line']
            ) {
                $error = 'Array with multiple values cannot be declared on a single line';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SingleLineNotAllowed');
                if (true === $fix) {
                    $phpcsFile->fixer->beginChangeset();
                    $phpcsFile->fixer->addNewline($arrayStart);

                    if (T_WHITESPACE === $tokens[($arrayEnd - 1)]['code']) {
                        $phpcsFile->fixer->replaceToken(($arrayEnd - 1), $phpcsFile->eolChar);
                    } else {
                        $phpcsFile->fixer->addNewlineBefore($arrayEnd);
                    }

                    $phpcsFile->fixer->endChangeset();
                }

                return;
            }

            // We have a multiple value array that is inside a condition or
            // function. Check its spacing is correct.
            foreach ($commas as $comma) {
                if (T_WHITESPACE !== $tokens[($comma + 1)]['code']) {
                    $content = $tokens[($comma + 1)]['content'];
                    $error = 'Expected 1 space between comma and "%s"; 0 found';
                    $data = [$content];
                    $fix = $phpcsFile->addFixableError($error, $comma, 'NoSpaceAfterComma', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->addContent($comma, ' ');
                    }
                } else {
                    $spaceLength = $tokens[($comma + 1)]['length'];
                    if (1 !== $spaceLength) {
                        $content = $tokens[($comma + 2)]['content'];
                        $error = 'Expected 1 space between comma and "%s"; %s found';
                        $data = [
                            $content,
                            $spaceLength,
                        ];

                        $fix = $phpcsFile->addFixableError($error, $comma, 'SpaceAfterComma', $data);
                        if (true === $fix) {
                            $phpcsFile->fixer->replaceToken(($comma + 1), ' ');
                        }
                    }
                }//end if

                if (T_WHITESPACE === $tokens[($comma - 1)]['code']) {
                    $content = $tokens[($comma - 2)]['content'];
                    $spaceLength = $tokens[($comma - 1)]['length'];
                    $error = 'Expected 0 spaces between "%s" and comma; %s found';
                    $data = [
                        $content,
                        $spaceLength,
                    ];

                    $fix = $phpcsFile->addFixableError($error, $comma, 'SpaceBeforeComma', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($comma - 1), '');
                    }
                }
            }//end foreach
        }//end if
    }

    //end processSingleLineArray()

    /**
     * Processes a multi-line array definition.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile  The current file being checked.
     * @param int                         $stackPtr   The position of the current token
     *                                                in the stack passed in $tokens.
     * @param int                         $arrayStart The token that starts the array definition.
     * @param int                         $arrayEnd   The token that ends the array definition.
     */
    public function processMultiLineArray($phpcsFile, $stackPtr, $arrayStart, $arrayEnd)
    {
        $tokens = $phpcsFile->getTokens();
        $keywordStart = $tokens[$stackPtr]['column'];

        // Check the closing bracket is on a new line.
        $lastContent = $phpcsFile->findPrevious(T_WHITESPACE, ($arrayEnd - 1), $arrayStart, true);
        if ($tokens[$lastContent]['line'] === $tokens[$arrayEnd]['line']) {
            $error = 'Closing parenthesis of array declaration must be on a new line';
            $fix = $phpcsFile->addFixableError($error, $arrayEnd, 'CloseBraceNewLine');
            if (true === $fix) {
                $phpcsFile->fixer->addNewlineBefore($arrayEnd);
            }
        } elseif ($tokens[$arrayEnd]['column'] !== $keywordStart) {
            // Check the closing bracket is lined up under the "a" in array.
            $expected = ($keywordStart - 1);
            $found = ($tokens[$arrayEnd]['column'] - 1);
            $error = 'Closing parenthesis not aligned correctly; expected %s space(s) but found %s';
            $data = [
                $expected,
                $found,
            ];

            $fix = $phpcsFile->addFixableError($error, $arrayEnd, 'CloseBraceNotAligned', $data);
            if (true === $fix) {
                if (0 === $found) {
                    $phpcsFile->fixer->addContent(($arrayEnd - 1), str_repeat(' ', $expected));
                } else {
                    $phpcsFile->fixer->replaceToken(($arrayEnd - 1), str_repeat(' ', $expected));
                }
            }
        }//end if

        $keyUsed = false;
        $singleUsed = false;
        $indices = [];
        $maxLength = 0;

        if (T_ARRAY === $tokens[$stackPtr]['code']) {
            $lastToken = $tokens[$stackPtr]['parenthesis_opener'];
        } else {
            $lastToken = $stackPtr;
        }

        // Find all the double arrows that reside in this scope.
        for ($nextToken = ($stackPtr + 1); $nextToken < $arrayEnd; ++$nextToken) {
            // Skip bracketed statements, like function calls.
            if (T_OPEN_PARENTHESIS === $tokens[$nextToken]['code']
                && (false === isset($tokens[$nextToken]['parenthesis_owner'])
                || $tokens[$nextToken]['parenthesis_owner'] !== $stackPtr)
            ) {
                $nextToken = $tokens[$nextToken]['parenthesis_closer'];

                continue;
            }

            if (T_ARRAY === $tokens[$nextToken]['code']
                || T_OPEN_SHORT_ARRAY === $tokens[$nextToken]['code']
                || T_CLOSURE === $tokens[$nextToken]['code']
                || T_FN === $tokens[$nextToken]['code']
            ) {
                // Let subsequent calls of this test handle nested arrays.
                if (T_DOUBLE_ARROW !== $tokens[$lastToken]['code']) {
                    $indices[] = ['value' => $nextToken];
                    $lastToken = $nextToken;
                }

                if (T_ARRAY === $tokens[$nextToken]['code']) {
                    $nextToken = $tokens[$tokens[$nextToken]['parenthesis_opener']]['parenthesis_closer'];
                } elseif (T_OPEN_SHORT_ARRAY === $tokens[$nextToken]['code']) {
                    $nextToken = $tokens[$nextToken]['bracket_closer'];
                } else {
                    // T_CLOSURE.
                    $nextToken = $tokens[$nextToken]['scope_closer'];
                }

                $nextToken = $phpcsFile->findNext(T_WHITESPACE, ($nextToken + 1), null, true);
                if (T_COMMA !== $tokens[$nextToken]['code']) {
                    --$nextToken;
                } else {
                    $lastToken = $nextToken;
                }

                continue;
            }//end if

            if (T_DOUBLE_ARROW !== $tokens[$nextToken]['code'] && T_COMMA !== $tokens[$nextToken]['code']) {
                continue;
            }

            $currentEntry = [];

            if (T_COMMA === $tokens[$nextToken]['code']) {
                $stackPtrCount = 0;
                if (true === isset($tokens[$stackPtr]['nested_parenthesis'])) {
                    $stackPtrCount = \count($tokens[$stackPtr]['nested_parenthesis']);
                }

                $commaCount = 0;
                if (true === isset($tokens[$nextToken]['nested_parenthesis'])) {
                    $commaCount = \count($tokens[$nextToken]['nested_parenthesis']);
                    if (T_ARRAY === $tokens[$stackPtr]['code']) {
                        // Remove parenthesis that are used to define the array.
                        --$commaCount;
                    }
                }

                if ($commaCount > $stackPtrCount) {
                    // This comma is inside more parenthesis than the ARRAY keyword,
                    // then there it is actually a comma used to separate arguments
                    // in a function call.
                    continue;
                }

                if (true === $keyUsed && T_COMMA === $tokens[$lastToken]['code']) {
                    $error = 'No key specified for array entry; first entry specifies key';
                    $phpcsFile->addError($error, $nextToken, 'NoKeySpecified');

                    return;
                }

                if (false === $keyUsed) {
                    if (T_WHITESPACE === $tokens[($nextToken - 1)]['code']) {
                        $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($nextToken - 1), null, true);
                        if ((T_END_HEREDOC !== $tokens[$prev]['code']
                            && T_END_NOWDOC !== $tokens[$prev]['code'])
                            || $tokens[($nextToken - 1)]['line'] === $tokens[$nextToken]['line']
                        ) {
                            if ($tokens[($nextToken - 1)]['content'] === $phpcsFile->eolChar) {
                                $spaceLength = 'newline';
                            } else {
                                $spaceLength = $tokens[($nextToken - 1)]['length'];
                            }

                            $error = 'Expected 0 spaces before comma; %s found';
                            $data = [$spaceLength];

                            // The error is only fixable if there is only whitespace between the tokens.
                            if ($prev === $phpcsFile->findPrevious(T_WHITESPACE, ($nextToken - 1), null, true)) {
                                $fix = $phpcsFile->addFixableError($error, $nextToken, 'SpaceBeforeComma', $data);
                                if (true === $fix) {
                                    $phpcsFile->fixer->replaceToken(($nextToken - 1), '');
                                }
                            } else {
                                $phpcsFile->addError($error, $nextToken, 'SpaceBeforeComma', $data);
                            }
                        }
                    }//end if

                    $valueContent = $phpcsFile->findNext(
                        Tokens::$emptyTokens,
                        ($lastToken + 1),
                        $nextToken,
                        true
                    );

                    $indices[] = ['value' => $valueContent];
                    $singleUsed = true;
                }//end if

                $lastToken = $nextToken;

                continue;
            }//end if

            if (T_DOUBLE_ARROW === $tokens[$nextToken]['code']) {
                if (true === $singleUsed) {
                    $error = 'Key specified for array entry; first entry has no key';
                    $phpcsFile->addError($error, $nextToken, 'KeySpecified');

                    return;
                }

                $currentEntry['arrow'] = $nextToken;
                $keyUsed = true;

                // Find the start of index that uses this double arrow.
                $indexEnd = $phpcsFile->findPrevious(T_WHITESPACE, ($nextToken - 1), $arrayStart, true);
                $indexStart = $phpcsFile->findStartOfStatement($indexEnd);

                if ($indexStart === $indexEnd) {
                    $currentEntry['index'] = $indexEnd;
                    $currentEntry['index_content'] = $tokens[$indexEnd]['content'];
                    $currentEntry['index_length'] = $tokens[$indexEnd]['length'];
                } else {
                    $currentEntry['index'] = $indexStart;
                    $currentEntry['index_content'] = '';
                    $currentEntry['index_length'] = 0;
                    for ($i = $indexStart; $i <= $indexEnd; ++$i) {
                        $currentEntry['index_content'] .= $tokens[$i]['content'];
                        $currentEntry['index_length'] += $tokens[$i]['length'];
                    }
                }

                if ($maxLength < $currentEntry['index_length']) {
                    $maxLength = $currentEntry['index_length'];
                }

                // Find the value of this index.
                $nextContent = $phpcsFile->findNext(
                    Tokens::$emptyTokens,
                    ($nextToken + 1),
                    $arrayEnd,
                    true
                );

                $currentEntry['value'] = $nextContent;
                $indices[] = $currentEntry;
                $lastToken = $nextToken;
            }//end if
        }//end for

        // Check for multi-line arrays that should be single-line.
        $singleValue = false;

        if (true === empty($indices)) {
            $singleValue = true;
        } elseif (1 === \count($indices) && T_COMMA === $tokens[$lastToken]['code']) {
            // There may be another array value without a comma.
            $exclude = Tokens::$emptyTokens;
            $exclude[] = T_COMMA;
            $nextContent = $phpcsFile->findNext($exclude, ($indices[0]['value'] + 1), $arrayEnd, true);
            if (false === $nextContent) {
                $singleValue = true;
            }
        }

        if (true === $singleValue) {
            // Before we complain, make sure the single value isn't a here/nowdoc.
            $next = $phpcsFile->findNext(Tokens::$heredocTokens, ($arrayStart + 1), ($arrayEnd - 1));
            if (false === $next) {
                // Array cannot be empty, so this is a multi-line array with
                // a single value. It should be defined on single line.
                $error = 'Multi-line array contains a single value; use single-line array instead';
                $errorCode = 'MultiLineNotAllowed';

                $find = Tokens::$phpcsCommentTokens;
                $find[] = T_COMMENT;
                $comment = $phpcsFile->findNext($find, ($arrayStart + 1), $arrayEnd);
                if (false === $comment) {
                    $fix = $phpcsFile->addFixableError($error, $stackPtr, $errorCode);
                } else {
                    $fix = false;
                    $phpcsFile->addError($error, $stackPtr, $errorCode);
                }

                if (true === $fix) {
                    $phpcsFile->fixer->beginChangeset();
                    for ($i = ($arrayStart + 1); $i < $arrayEnd; ++$i) {
                        if (T_WHITESPACE !== $tokens[$i]['code']) {
                            break;
                        }

                        $phpcsFile->fixer->replaceToken($i, '');
                    }

                    for ($i = ($arrayEnd - 1); $i > $arrayStart; --$i) {
                        if (T_WHITESPACE !== $tokens[$i]['code']) {
                            break;
                        }

                        $phpcsFile->fixer->replaceToken($i, '');
                    }

                    $phpcsFile->fixer->endChangeset();
                }

                return;
            }//end if
        }//end if

        /*
            This section checks for arrays that don't specify keys.

            Arrays such as:
               array(
                'aaa',
                'bbb',
                'd',
               );
        */

        if (false === $keyUsed && false === empty($indices)) {
            $count = \count($indices);
            $lastIndex = $indices[($count - 1)]['value'];

            $trailingContent = $phpcsFile->findPrevious(
                Tokens::$emptyTokens,
                ($arrayEnd - 1),
                $lastIndex,
                true
            );

            if (T_COMMA !== $tokens[$trailingContent]['code']) {
                $phpcsFile->recordMetric($stackPtr, 'Array end comma', 'no');
                $error = 'Comma required after last value in array declaration';
                $fix = $phpcsFile->addFixableError($error, $trailingContent, 'NoCommaAfterLast');
                if (true === $fix) {
                    $phpcsFile->fixer->addContent($trailingContent, ',');
                }
            } else {
                $phpcsFile->recordMetric($stackPtr, 'Array end comma', 'yes');
            }

            foreach ($indices as $valuePosition => $value) {
                if (true === empty($value['value'])) {
                    // Array was malformed and we couldn't figure out
                    // the array value correctly, so we have to ignore it.
                    // Other parts of this sniff will correct the error.
                    continue;
                }

                $valuePointer = $value['value'];

                $ignoreTokens = [
                    T_WHITESPACE => T_WHITESPACE,
                    T_COMMA => T_COMMA,
                ];
                $ignoreTokens += Tokens::$castTokens;

                if (T_CLOSURE === $tokens[$valuePointer]['code']
                    || T_FN === $tokens[$valuePointer]['code']
                ) {
                    $ignoreTokens += [T_STATIC => T_STATIC];
                }

                $previous = $phpcsFile->findPrevious($ignoreTokens, ($valuePointer - 1), ($arrayStart + 1), true);
                if (false === $previous) {
                    $previous = $stackPtr;
                }

                $previousIsWhitespace = T_WHITESPACE === $tokens[($valuePointer - 1)]['code'];
                if ($tokens[$previous]['line'] === $tokens[$valuePointer]['line']) {
                    $error = 'Each value in a multi-line array must be on a new line';
                    if (0 === $valuePosition) {
                        $error = 'The first value in a multi-value array must be on a new line';
                    }

                    $fix = $phpcsFile->addFixableError($error, $valuePointer, 'ValueNoNewline');
                    if (true === $fix) {
                        if (true === $previousIsWhitespace) {
                            $phpcsFile->fixer->replaceToken(($valuePointer - 1), $phpcsFile->eolChar);
                        } else {
                            $phpcsFile->fixer->addNewlineBefore($valuePointer);
                        }
                    }
                } elseif (true === $previousIsWhitespace) {
                    $expected = $keywordStart;

                    $first = $phpcsFile->findFirstOnLine(T_WHITESPACE, $valuePointer, true);
                    $found = ($tokens[$first]['column'] - 1);
                    if ($found !== $expected) {
                        $error = 'Array value not aligned correctly; expected %s spaces but found %s';
                        $data = [
                            $expected,
                            $found,
                        ];

                        $fix = $phpcsFile->addFixableError($error, $first, 'ValueNotAligned', $data);
                        if (true === $fix) {
                            if (0 === $found) {
                                $phpcsFile->fixer->addContent(($first - 1), str_repeat(' ', $expected));
                            } else {
                                $phpcsFile->fixer->replaceToken(($first - 1), str_repeat(' ', $expected));
                            }
                        }
                    }
                }//end if
            }//end foreach
        }//end if

        /*
            Below the actual indentation of the array is checked.
            Errors will be thrown when a key is not aligned, when
            a double arrow is not aligned, and when a value is not
            aligned correctly.
            If an error is found in one of the above areas, then errors
            are not reported for the rest of the line to avoid reporting
            spaces and columns incorrectly. Often fixing the first
            problem will fix the other 2 anyway.

            For example:

            $a = array(
                  'index'  => '2',
                 );

            or

            $a = [
                  'index'  => '2',
                 ];

            In this array, the double arrow is indented too far, but this
            will also cause an error in the value's alignment. If the arrow were
            to be moved back one space however, then both errors would be fixed.
        */

        $indicesStart = ($keywordStart + 1);
        foreach ($indices as $valuePosition => $index) {
            $valuePointer = $index['value'];
            if (false === $valuePointer) {
                // Syntax error or live coding.
                continue;
            }

            if (false === isset($index['index'])) {
                // Array value only.
                continue;
            }

            $indexPointer = $index['index'];
            $indexLine = $tokens[$indexPointer]['line'];

            $previous = $phpcsFile->findPrevious([T_WHITESPACE, T_COMMA], ($indexPointer - 1), ($arrayStart + 1), true);
            if (false === $previous) {
                $previous = $stackPtr;
            }

            if ($tokens[$previous]['line'] === $indexLine) {
                $error = 'Each index in a multi-line array must be on a new line';
                if (0 === $valuePosition) {
                    $error = 'The first index in a multi-value array must be on a new line';
                }

                $fix = $phpcsFile->addFixableError($error, $indexPointer, 'IndexNoNewline');
                if (true === $fix) {
                    if (T_WHITESPACE === $tokens[($indexPointer - 1)]['code']) {
                        $phpcsFile->fixer->replaceToken(($indexPointer - 1), $phpcsFile->eolChar);
                    } else {
                        $phpcsFile->fixer->addNewlineBefore($indexPointer);
                    }
                }

                continue;
            }

            if ($tokens[$indexPointer]['column'] !== $indicesStart && ($indexPointer - 1) !== $arrayStart) {
                $expected = ($indicesStart - 1);
                $found = ($tokens[$indexPointer]['column'] - 1);
                $error = 'Array key not aligned correctly; expected %s spaces but found %s';
                $data = [
                    $expected,
                    $found,
                ];

                $fix = $phpcsFile->addFixableError($error, $indexPointer, 'KeyNotAligned', $data);
                if (true === $fix) {
                    if (0 === $found || T_WHITESPACE !== $tokens[($indexPointer - 1)]['code']) {
                        $phpcsFile->fixer->addContent(($indexPointer - 1), str_repeat(' ', $expected));
                    } else {
                        $phpcsFile->fixer->replaceToken(($indexPointer - 1), str_repeat(' ', $expected));
                    }
                }
            }

            $arrowStart = ($tokens[$indexPointer]['column'] + $maxLength + 1);
            if ($tokens[$index['arrow']]['column'] !== $arrowStart) {
                $expected = ($arrowStart - ($index['index_length'] + $tokens[$indexPointer]['column']));
                $found = ($tokens[$index['arrow']]['column'] - ($index['index_length'] + $tokens[$indexPointer]['column']));
                $error = 'Array double arrow not aligned correctly; expected %s space(s) but found %s';
                $data = [
                    $expected,
                    $found,
                ];

                $fix = $phpcsFile->addFixableError($error, $index['arrow'], 'DoubleArrowNotAligned', $data);
                if (true === $fix) {
                    if (0 === $found) {
                        $phpcsFile->fixer->addContent(($index['arrow'] - 1), str_repeat(' ', $expected));
                    } else {
                        $phpcsFile->fixer->replaceToken(($index['arrow'] - 1), str_repeat(' ', $expected));
                    }
                }

                continue;
            }

            $valueStart = ($arrowStart + 3);
            if ($tokens[$valuePointer]['column'] !== $valueStart) {
                $expected = ($valueStart - ($tokens[$index['arrow']]['length'] + $tokens[$index['arrow']]['column']));
                $found = ($tokens[$valuePointer]['column'] - ($tokens[$index['arrow']]['length'] + $tokens[$index['arrow']]['column']));
                if ($found < 0) {
                    $found = 'newline';
                }

                $error = 'Array value not aligned correctly; expected %s space(s) but found %s';
                $data = [
                    $expected,
                    $found,
                ];

                $fix = $phpcsFile->addFixableError($error, $index['arrow'], 'ValueNotAligned', $data);
                if (true === $fix) {
                    if ('newline' === $found) {
                        $prev = $phpcsFile->findPrevious(T_WHITESPACE, ($valuePointer - 1), null, true);
                        $phpcsFile->fixer->beginChangeset();
                        for ($i = ($prev + 1); $i < $valuePointer; ++$i) {
                            $phpcsFile->fixer->replaceToken($i, '');
                        }

                        $phpcsFile->fixer->replaceToken(($valuePointer - 1), str_repeat(' ', $expected));
                        $phpcsFile->fixer->endChangeset();
                    } elseif (0 === $found) {
                        $phpcsFile->fixer->addContent(($valuePointer - 1), str_repeat(' ', $expected));
                    } else {
                        $phpcsFile->fixer->replaceToken(($valuePointer - 1), str_repeat(' ', $expected));
                    }
                }
            }//end if

            // Check each line ends in a comma.
            $valueStart = $valuePointer;
            $nextComma = false;

            $end = $phpcsFile->findEndOfStatement($valueStart);
            if (false === $end) {
                $valueEnd = $valueStart;
            } elseif (T_COMMA === $tokens[$end]['code']) {
                $valueEnd = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($end - 1), $valueStart, true);
                $nextComma = $end;
            } else {
                $valueEnd = $end;
                $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($end + 1), $arrayEnd, true);
                if (false !== $next && T_COMMA === $tokens[$next]['code']) {
                    $nextComma = $next;
                }
            }

            $valueLine = $tokens[$valueEnd]['line'];
            if (T_END_HEREDOC === $tokens[$valueEnd]['code'] || T_END_NOWDOC === $tokens[$valueEnd]['code']) {
                ++$valueLine;
            }

            if (false === $nextComma || ($tokens[$nextComma]['line'] !== $valueLine)) {
                $error = 'Each line in an array declaration must end in a comma';
                $fix = $phpcsFile->addFixableError($error, $valuePointer, 'NoComma');

                if (true === $fix) {
                    // Find the end of the line and put a comma there.
                    for ($i = ($valuePointer + 1); $i <= $arrayEnd; ++$i) {
                        if ($tokens[$i]['line'] > $valueLine) {
                            break;
                        }
                    }

                    $phpcsFile->fixer->beginChangeset();
                    $phpcsFile->fixer->addContentBefore(($i - 1), ',');
                    if (false !== $nextComma) {
                        $phpcsFile->fixer->replaceToken($nextComma, '');
                    }

                    $phpcsFile->fixer->endChangeset();
                }
            }//end if

            // Check that there is no space before the comma.
            if (false !== $nextComma && T_WHITESPACE === $tokens[($nextComma - 1)]['code']) {
                // Here/nowdoc closing tags must have the comma on the next line.
                $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($nextComma - 1), null, true);
                if (T_END_HEREDOC !== $tokens[$prev]['code'] && T_END_NOWDOC !== $tokens[$prev]['code']) {
                    $content = $tokens[($nextComma - 2)]['content'];
                    $spaceLength = $tokens[($nextComma - 1)]['length'];
                    $error = 'Expected 0 spaces between "%s" and comma; %s found';
                    $data = [
                        $content,
                        $spaceLength,
                    ];

                    $fix = $phpcsFile->addFixableError($error, $nextComma, 'SpaceBeforeComma', $data);
                    if (true === $fix) {
                        $phpcsFile->fixer->replaceToken(($nextComma - 1), '');
                    }
                }
            }
        }//end foreach
    }

    //end processMultiLineArray()
}//end class
