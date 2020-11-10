<?php
/**
 * Parses and verifies the doc comments for functions.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting;

use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\Commenting\FunctionCommentSniff as PEARFunctionCommentSniff;
use PHP_CodeSniffer\Util\Common;

class FunctionCommentSniff extends PEARFunctionCommentSniff
{
    /**
     * The current PHP version.
     *
     * @var int
     */
    private $phpVersion;

    /**
     * Process the return comment of this function comment.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile    The file being scanned.
     * @param int                         $stackPtr     The position of the current token
     *                                                  in the stack passed in $tokens.
     * @param int                         $commentStart The position in the stack where the comment started.
     */
    protected function processReturn(File $phpcsFile, $stackPtr, $commentStart)
    {
        $tokens = $phpcsFile->getTokens();
        $return = null;

        foreach ($tokens[$commentStart]['comment_tags'] as $tag) {
            if ('@return' === $tokens[$tag]['content']) {
                if (null !== $return) {
                    $error = 'Only 1 @return tag is allowed in a function comment';
                    $phpcsFile->addError($error, $tag, 'DuplicateReturn');

                    return;
                }

                $return = $tag;
            }
        }

        // Skip constructor and destructor.
        $methodName = $phpcsFile->getDeclarationName($stackPtr);
        $isSpecialMethod = ('__construct' === $methodName || '__destruct' === $methodName);
        if (true === $isSpecialMethod) {
            return;
        }

        if (null !== $return) {
            $content = $tokens[($return + 2)]['content'];
            if (true === empty($content) || T_DOC_COMMENT_STRING !== $tokens[($return + 2)]['code']) {
                $error = 'Return type missing for @return tag in function comment';
                $phpcsFile->addError($error, $return, 'MissingReturnType');
            } else {
                // Support both a return type and a description.
                preg_match('`^((?:\|?(?:array\([^\)]*\)|[\\\\a-z0-9\[\]]+))*)( .*)?`i', $content, $returnParts);
                if (false === isset($returnParts[1])) {
                    return;
                }

                $returnType = $returnParts[1];

                // Check return type (can be multiple, separated by '|').
                $typeNames = explode('|', $returnType);
                $suggestedNames = [];
                foreach ($typeNames as $i => $typeName) {
                    $suggestedName = Common::suggestType($typeName);
                    if (false === \in_array($suggestedName, $suggestedNames, true)) {
                        $suggestedNames[] = $suggestedName;
                    }
                }

                $suggestedType = implode('|', $suggestedNames);
                if ($returnType !== $suggestedType) {
                    $error = 'Expected "%s" but found "%s" for function return type';
                    $data = [
                        $suggestedType,
                        $returnType,
                    ];
                    $fix = $phpcsFile->addFixableError($error, $return, 'InvalidReturn', $data);
                    if (true === $fix) {
                        $replacement = $suggestedType;
                        if (false === empty($returnParts[2])) {
                            $replacement .= $returnParts[2];
                        }

                        $phpcsFile->fixer->replaceToken(($return + 2), $replacement);
                        unset($replacement);
                    }
                }

                // If the return type is void, make sure there is
                // no return statement in the function.
                if ('void' === $returnType) {
                    if (true === isset($tokens[$stackPtr]['scope_closer'])) {
                        $endToken = $tokens[$stackPtr]['scope_closer'];
                        for ($returnToken = $stackPtr; $returnToken < $endToken; ++$returnToken) {
                            if (T_CLOSURE === $tokens[$returnToken]['code']
                                || T_ANON_CLASS === $tokens[$returnToken]['code']
                            ) {
                                $returnToken = $tokens[$returnToken]['scope_closer'];

                                continue;
                            }

                            if (T_RETURN === $tokens[$returnToken]['code']
                                || T_YIELD === $tokens[$returnToken]['code']
                                || T_YIELD_FROM === $tokens[$returnToken]['code']
                            ) {
                                break;
                            }
                        }

                        if ($returnToken !== $endToken) {
                            // If the function is not returning anything, just
                            // exiting, then there is no problem.
                            $semicolon = $phpcsFile->findNext(T_WHITESPACE, ($returnToken + 1), null, true);
                            if (T_SEMICOLON !== $tokens[$semicolon]['code']) {
                                $error = 'Function return type is void, but function contains return statement';
                                $phpcsFile->addError($error, $return, 'InvalidReturnVoid');
                            }
                        }
                    }//end if
                } elseif ('mixed' !== $returnType && false === \in_array('void', $typeNames, true)) {
                    // If return type is not void, there needs to be a return statement
                    // somewhere in the function that returns something.
                    if (true === isset($tokens[$stackPtr]['scope_closer'])) {
                        $endToken = $tokens[$stackPtr]['scope_closer'];
                        for ($returnToken = $stackPtr; $returnToken < $endToken; ++$returnToken) {
                            if (T_CLOSURE === $tokens[$returnToken]['code']
                                || T_ANON_CLASS === $tokens[$returnToken]['code']
                            ) {
                                $returnToken = $tokens[$returnToken]['scope_closer'];

                                continue;
                            }

                            if (T_RETURN === $tokens[$returnToken]['code']
                                || T_YIELD === $tokens[$returnToken]['code']
                                || T_YIELD_FROM === $tokens[$returnToken]['code']
                            ) {
                                break;
                            }
                        }

                        if ($returnToken === $endToken) {
                            $error = 'Function return type is not void, but function has no return statement';
                            $phpcsFile->addError($error, $return, 'InvalidNoReturn');
                        } else {
                            $semicolon = $phpcsFile->findNext(T_WHITESPACE, ($returnToken + 1), null, true);
                            if (T_SEMICOLON === $tokens[$semicolon]['code']) {
                                $error = 'Function return type is not void, but function is returning void here';
                                $phpcsFile->addError($error, $returnToken, 'InvalidReturnNotVoid');
                            }
                        }
                    }//end if
                }//end if
            }//end if
        } else {
            $error = 'Missing @return tag in function comment';
            $phpcsFile->addError($error, $tokens[$commentStart]['comment_closer'], 'MissingReturn');
        }//end if
    }

    //end processReturn()

    /**
     * Process any throw tags that this function comment has.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile    The file being scanned.
     * @param int                         $stackPtr     The position of the current token
     *                                                  in the stack passed in $tokens.
     * @param int                         $commentStart The position in the stack where the comment started.
     */
    protected function processThrows(File $phpcsFile, $stackPtr, $commentStart)
    {
        $tokens = $phpcsFile->getTokens();

        foreach ($tokens[$commentStart]['comment_tags'] as $pos => $tag) {
            if ('@throws' !== $tokens[$tag]['content']) {
                continue;
            }

            $exception = null;
            $comment = null;
            if (T_DOC_COMMENT_STRING === $tokens[($tag + 2)]['code']) {
                $matches = [];
                preg_match('/([^\s]+)(?:\s+(.*))?/', $tokens[($tag + 2)]['content'], $matches);
                $exception = $matches[1];
                if (true === isset($matches[2]) && '' !== trim($matches[2])) {
                    $comment = $matches[2];
                }
            }

            if (null === $exception) {
                $error = 'Exception type and comment missing for @throws tag in function comment';
                $phpcsFile->addError($error, $tag, 'InvalidThrows');
            } elseif (null === $comment) {
                $error = 'Comment missing for @throws tag in function comment';
                $phpcsFile->addError($error, $tag, 'EmptyThrows');
            } else {
                // Any strings until the next tag belong to this comment.
                if (true === isset($tokens[$commentStart]['comment_tags'][($pos + 1)])) {
                    $end = $tokens[$commentStart]['comment_tags'][($pos + 1)];
                } else {
                    $end = $tokens[$commentStart]['comment_closer'];
                }

                for ($i = ($tag + 3); $i < $end; ++$i) {
                    if (T_DOC_COMMENT_STRING === $tokens[$i]['code']) {
                        $comment .= ' ' . $tokens[$i]['content'];
                    }
                }

                // Starts with a capital letter and ends with a fullstop.
                $firstChar = $comment[0];
                if (strtoupper($firstChar) !== $firstChar) {
                    $error = '@throws tag comment must start with a capital letter';
                    $phpcsFile->addError($error, ($tag + 2), 'ThrowsNotCapital');
                }

                $lastChar = substr($comment, -1);
                if ('.' !== $lastChar) {
                    $error = '@throws tag comment must end with a full stop';
                    $phpcsFile->addError($error, ($tag + 2), 'ThrowsNoFullStop');
                }
            }//end if
        }//end foreach
    }

    //end processThrows()

    /**
     * Process the function parameter comments.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile    The file being scanned.
     * @param int                         $stackPtr     The position of the current token
     *                                                  in the stack passed in $tokens.
     * @param int                         $commentStart The position in the stack where the comment started.
     */
    protected function processParams(File $phpcsFile, $stackPtr, $commentStart)
    {
        if (null === $this->phpVersion) {
            $this->phpVersion = Config::getConfigData('php_version');
            if (null === $this->phpVersion) {
                $this->phpVersion = \PHP_VERSION_ID;
            }
        }

        $tokens = $phpcsFile->getTokens();

        $params = [];
        $maxType = 0;
        $maxVar = 0;
        foreach ($tokens[$commentStart]['comment_tags'] as $pos => $tag) {
            if ('@param' !== $tokens[$tag]['content']) {
                continue;
            }

            $type = '';
            $typeSpace = 0;
            $var = '';
            $varSpace = 0;
            $comment = '';
            $commentLines = [];
            if (T_DOC_COMMENT_STRING === $tokens[($tag + 2)]['code']) {
                $matches = [];
                preg_match('/([^$&.]+)(?:((?:\.\.\.)?(?:\$|&)[^\s]+)(?:(\s+)(.*))?)?/', $tokens[($tag + 2)]['content'], $matches);

                if (false === empty($matches)) {
                    $typeLen = \strlen($matches[1]);
                    $type = trim($matches[1]);
                    $typeSpace = ($typeLen - \strlen($type));
                    $typeLen = \strlen($type);
                    if ($typeLen > $maxType) {
                        $maxType = $typeLen;
                    }
                }

                if (true === isset($matches[2])) {
                    $var = $matches[2];
                    $varLen = \strlen($var);
                    if ($varLen > $maxVar) {
                        $maxVar = $varLen;
                    }

                    if (true === isset($matches[4])) {
                        $varSpace = \strlen($matches[3]);
                        $comment = $matches[4];
                        $commentLines[] = [
                            'comment' => $comment,
                            'token' => ($tag + 2),
                            'indent' => $varSpace,
                        ];

                        // Any strings until the next tag belong to this comment.
                        if (true === isset($tokens[$commentStart]['comment_tags'][($pos + 1)])) {
                            $end = $tokens[$commentStart]['comment_tags'][($pos + 1)];
                        } else {
                            $end = $tokens[$commentStart]['comment_closer'];
                        }

                        for ($i = ($tag + 3); $i < $end; ++$i) {
                            if (T_DOC_COMMENT_STRING === $tokens[$i]['code']) {
                                $indent = 0;
                                if (T_DOC_COMMENT_WHITESPACE === $tokens[($i - 1)]['code']) {
                                    $indent = $tokens[($i - 1)]['length'];
                                }

                                $comment .= ' ' . $tokens[$i]['content'];
                                $commentLines[] = [
                                    'comment' => $tokens[$i]['content'],
                                    'token' => $i,
                                    'indent' => $indent,
                                ];
                            }
                        }
                    } else {
                        $error = 'Missing parameter comment';
                        $phpcsFile->addError($error, $tag, 'MissingParamComment');
                        $commentLines[] = ['comment' => ''];
                    }//end if
                } else {
                    $error = 'Missing parameter name';
                    $phpcsFile->addError($error, $tag, 'MissingParamName');
                }//end if
            } else {
                $error = 'Missing parameter type';
                $phpcsFile->addError($error, $tag, 'MissingParamType');
            }//end if

            $params[] = [
                'tag' => $tag,
                'type' => $type,
                'var' => $var,
                'comment' => $comment,
                'commentLines' => $commentLines,
                'type_space' => $typeSpace,
                'var_space' => $varSpace,
            ];
        }//end foreach

        $realParams = $phpcsFile->getMethodParameters($stackPtr);
        $foundParams = [];

        // We want to use ... for all variable length arguments, so added
        // this prefix to the variable name so comparisons are easier.
        foreach ($realParams as $pos => $param) {
            if (true === $param['variable_length']) {
                $realParams[$pos]['name'] = '...' . $realParams[$pos]['name'];
            }
        }

        foreach ($params as $pos => $param) {
            // If the type is empty, the whole line is empty.
            if ('' === $param['type']) {
                continue;
            }

            // Check the param type value.
            $typeNames = explode('|', $param['type']);
            $suggestedTypeNames = [];

            foreach ($typeNames as $typeName) {
                // Strip nullable operator.
                if ('?' === $typeName[0]) {
                    $typeName = substr($typeName, 1);
                }

                $suggestedName = Common::suggestType($typeName);
                $suggestedTypeNames[] = $suggestedName;

                if (\count($typeNames) > 1) {
                    continue;
                }

                // Check type hint for array and custom type.
                $suggestedTypeHint = '';
                if (false !== strpos($suggestedName, 'array') || '[]' === substr($suggestedName, -2)) {
                    $suggestedTypeHint = 'array';
                } elseif (false !== strpos($suggestedName, 'callable')) {
                    $suggestedTypeHint = 'callable';
                } elseif (false !== strpos($suggestedName, 'callback')) {
                    $suggestedTypeHint = 'callable';
                } elseif (false === \in_array($suggestedName, Common::$allowedTypes, true)) {
                    $suggestedTypeHint = $suggestedName;
                }

                if ($this->phpVersion >= 70000) {
                    if ('string' === $suggestedName) {
                        $suggestedTypeHint = 'string';
                    } elseif ('int' === $suggestedName || 'integer' === $suggestedName) {
                        $suggestedTypeHint = 'int';
                    } elseif ('float' === $suggestedName) {
                        $suggestedTypeHint = 'float';
                    } elseif ('bool' === $suggestedName || 'boolean' === $suggestedName) {
                        $suggestedTypeHint = 'bool';
                    }
                }

                if ($this->phpVersion >= 70200) {
                    if ('object' === $suggestedName) {
                        $suggestedTypeHint = 'object';
                    }
                }

                if ('' !== $suggestedTypeHint && true === isset($realParams[$pos])) {
                    $typeHint = $realParams[$pos]['type_hint'];

                    // Remove namespace prefixes when comparing.
                    $compareTypeHint = substr($suggestedTypeHint, (\strlen($typeHint) * -1));

                    if ('' === $typeHint) {
                        $error = 'Type hint "%s" missing for %s';
                        $data = [
                            $suggestedTypeHint,
                            $param['var'],
                        ];

                        $errorCode = 'TypeHintMissing';
                        if ('string' === $suggestedTypeHint
                            || 'int' === $suggestedTypeHint
                            || 'float' === $suggestedTypeHint
                            || 'bool' === $suggestedTypeHint
                        ) {
                            $errorCode = 'Scalar' . $errorCode;
                        }

                        $phpcsFile->addError($error, $stackPtr, $errorCode, $data);
                    } elseif ($typeHint !== $compareTypeHint && $typeHint !== '?' . $compareTypeHint) {
                        $error = 'Expected type hint "%s"; found "%s" for %s';
                        $data = [
                            $suggestedTypeHint,
                            $typeHint,
                            $param['var'],
                        ];
                        $phpcsFile->addError($error, $stackPtr, 'IncorrectTypeHint', $data);
                    }//end if
                } elseif ('' === $suggestedTypeHint && true === isset($realParams[$pos])) {
                    $typeHint = $realParams[$pos]['type_hint'];
                    if ('' !== $typeHint) {
                        $error = 'Unknown type hint "%s" found for %s';
                        $data = [
                            $typeHint,
                            $param['var'],
                        ];
                        $phpcsFile->addError($error, $stackPtr, 'InvalidTypeHint', $data);
                    }
                }//end if
            }//end foreach

            $suggestedType = implode('|', $suggestedTypeNames);
            if ($param['type'] !== $suggestedType) {
                $error = 'Expected "%s" but found "%s" for parameter type';
                $data = [
                    $suggestedType,
                    $param['type'],
                ];

                $fix = $phpcsFile->addFixableError($error, $param['tag'], 'IncorrectParamVarName', $data);
                if (true === $fix) {
                    $phpcsFile->fixer->beginChangeset();

                    $content = $suggestedType;
                    $content .= str_repeat(' ', $param['type_space']);
                    $content .= $param['var'];
                    $content .= str_repeat(' ', $param['var_space']);
                    if (true === isset($param['commentLines'][0])) {
                        $content .= $param['commentLines'][0]['comment'];
                    }

                    $phpcsFile->fixer->replaceToken(($param['tag'] + 2), $content);

                    // Fix up the indent of additional comment lines.
                    foreach ($param['commentLines'] as $lineNum => $line) {
                        if (0 === $lineNum
                            || 0 === $param['commentLines'][$lineNum]['indent']
                        ) {
                            continue;
                        }

                        $diff = (\strlen($param['type']) - \strlen($suggestedType));
                        $newIndent = ($param['commentLines'][$lineNum]['indent'] - $diff);
                        $phpcsFile->fixer->replaceToken(
                            ($param['commentLines'][$lineNum]['token'] - 1),
                            str_repeat(' ', $newIndent)
                        );
                    }

                    $phpcsFile->fixer->endChangeset();
                }//end if
            }//end if

            if ('' === $param['var']) {
                continue;
            }

            $foundParams[] = $param['var'];

            // Check number of spaces after the type.
            $this->checkSpacingAfterParamType($phpcsFile, $param, $maxType);

            // Make sure the param name is correct.
            if (true === isset($realParams[$pos])) {
                $realName = $realParams[$pos]['name'];
                if ($realName !== $param['var']) {
                    $code = 'ParamNameNoMatch';
                    $data = [
                        $param['var'],
                        $realName,
                    ];

                    $error = 'Doc comment for parameter %s does not match ';
                    if (strtolower($param['var']) === strtolower($realName)) {
                        $error .= 'case of ';
                        $code = 'ParamNameNoCaseMatch';
                    }

                    $error .= 'actual variable name %s';

                    $phpcsFile->addError($error, $param['tag'], $code, $data);
                }
            } elseif (',...' !== substr($param['var'], -4)) {
                // We must have an extra parameter comment.
                $error = 'Superfluous parameter comment';
                $phpcsFile->addError($error, $param['tag'], 'ExtraParamComment');
            }//end if

            if ('' === $param['comment']) {
                continue;
            }

            // Check number of spaces after the var name.
            $this->checkSpacingAfterParamName($phpcsFile, $param, $maxVar);

            // Param comments must start with a capital letter and end with a full stop.
            if (1 === preg_match('/^(\p{Ll}|\P{L})/u', $param['comment'])) {
                $error = 'Parameter comment must start with a capital letter';
                $phpcsFile->addError($error, $param['tag'], 'ParamCommentNotCapital');
            }

            $lastChar = substr($param['comment'], -1);
            if ('.' !== $lastChar) {
                $error = 'Parameter comment must end with a full stop';
                $phpcsFile->addError($error, $param['tag'], 'ParamCommentFullStop');
            }
        }//end foreach

        $realNames = [];
        foreach ($realParams as $realParam) {
            $realNames[] = $realParam['name'];
        }

        // Report missing comments.
        $diff = array_diff($realNames, $foundParams);
        foreach ($diff as $neededParam) {
            $error = 'Doc comment for parameter "%s" missing';
            $data = [$neededParam];
            $phpcsFile->addError($error, $commentStart, 'MissingParamTag', $data);
        }
    }

    //end processParams()

    /**
     * Check the spacing after the type of a parameter.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param array                       $param     The parameter to be checked.
     * @param int                         $maxType   The maxlength of the longest parameter type.
     * @param int                         $spacing   The number of spaces to add after the type.
     */
    protected function checkSpacingAfterParamType(File $phpcsFile, $param, $maxType, $spacing = 1)
    {
        // Check number of spaces after the type.
        $spaces = ($maxType - \strlen($param['type']) + $spacing);
        if ($param['type_space'] !== $spaces) {
            $error = 'Expected %s spaces after parameter type; %s found';
            $data = [
                $spaces,
                $param['type_space'],
            ];

            $fix = $phpcsFile->addFixableError($error, $param['tag'], 'SpacingAfterParamType', $data);
            if (true === $fix) {
                $phpcsFile->fixer->beginChangeset();

                $content = $param['type'];
                $content .= str_repeat(' ', $spaces);
                $content .= $param['var'];
                $content .= str_repeat(' ', $param['var_space']);
                $content .= $param['commentLines'][0]['comment'];
                $phpcsFile->fixer->replaceToken(($param['tag'] + 2), $content);

                // Fix up the indent of additional comment lines.
                $diff = ($param['type_space'] - $spaces);
                foreach ($param['commentLines'] as $lineNum => $line) {
                    if (0 === $lineNum
                        || 0 === $param['commentLines'][$lineNum]['indent']
                    ) {
                        continue;
                    }

                    $newIndent = ($param['commentLines'][$lineNum]['indent'] - $diff);
                    if ($newIndent <= 0) {
                        continue;
                    }

                    $phpcsFile->fixer->replaceToken(
                        ($param['commentLines'][$lineNum]['token'] - 1),
                        str_repeat(' ', $newIndent)
                    );
                }

                $phpcsFile->fixer->endChangeset();
            }//end if
        }//end if
    }

    //end checkSpacingAfterParamType()

    /**
     * Check the spacing after the name of a parameter.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param array                       $param     The parameter to be checked.
     * @param int                         $maxVar    The maxlength of the longest parameter name.
     * @param int                         $spacing   The number of spaces to add after the type.
     */
    protected function checkSpacingAfterParamName(File $phpcsFile, $param, $maxVar, $spacing = 1)
    {
        // Check number of spaces after the var name.
        $spaces = ($maxVar - \strlen($param['var']) + $spacing);
        if ($param['var_space'] !== $spaces) {
            $error = 'Expected %s spaces after parameter name; %s found';
            $data = [
                $spaces,
                $param['var_space'],
            ];

            $fix = $phpcsFile->addFixableError($error, $param['tag'], 'SpacingAfterParamName', $data);
            if (true === $fix) {
                $phpcsFile->fixer->beginChangeset();

                $content = $param['type'];
                $content .= str_repeat(' ', $param['type_space']);
                $content .= $param['var'];
                $content .= str_repeat(' ', $spaces);
                $content .= $param['commentLines'][0]['comment'];
                $phpcsFile->fixer->replaceToken(($param['tag'] + 2), $content);

                // Fix up the indent of additional comment lines.
                foreach ($param['commentLines'] as $lineNum => $line) {
                    if (0 === $lineNum
                        || 0 === $param['commentLines'][$lineNum]['indent']
                    ) {
                        continue;
                    }

                    $diff = ($param['var_space'] - $spaces);
                    $newIndent = ($param['commentLines'][$lineNum]['indent'] - $diff);
                    if ($newIndent <= 0) {
                        continue;
                    }

                    $phpcsFile->fixer->replaceToken(
                        ($param['commentLines'][$lineNum]['token'] - 1),
                        str_repeat(' ', $newIndent)
                    );
                }

                $phpcsFile->fixer->endChangeset();
            }//end if
        }//end if
    }

    //end checkSpacingAfterParamName()
}//end class
