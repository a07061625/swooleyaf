<?php
/**
 * Checks for unused function parameters.
 *
 * This sniff checks that all function parameters are used in the function body.
 * One exception is made for empty function bodies or function bodies that only
 * contain comments. This could be useful for the classes that implement an
 * interface that defines multiple methods but the implementation only needs some
 * of them.
 *
 * @author    Manuel Pichler <mapi@manuel-pichler.de>
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2007-2014 Manuel Pichler. All rights reserved.
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class UnusedFunctionParameterSniff implements Sniff
{
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
     *                                               in the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $token = $tokens[$stackPtr];

        // Skip broken function declarations.
        if (false === isset($token['scope_opener']) || false === isset($token['parenthesis_opener'])) {
            return;
        }

        $errorCode = 'Found';
        $implements = false;
        $extends = false;
        $classPtr = $phpcsFile->getCondition($stackPtr, T_CLASS);
        if (false !== $classPtr) {
            $implements = $phpcsFile->findImplementedInterfaceNames($classPtr);
            $extends = $phpcsFile->findExtendedClassName($classPtr);
            if (false !== $extends) {
                $errorCode .= 'InExtendedClass';
            } elseif (false !== $implements) {
                $errorCode .= 'InImplementedInterface';
            }
        }

        $params = [];
        $methodParams = $phpcsFile->getMethodParameters($stackPtr);

        // Skip when no parameters found.
        $methodParamsCount = \count($methodParams);
        if (0 === $methodParamsCount) {
            return;
        }

        foreach ($methodParams as $param) {
            $params[$param['name']] = $stackPtr;
        }

        $next = ++$token['scope_opener'];
        $end = --$token['scope_closer'];

        $foundContent = false;
        $validTokens = [
            T_HEREDOC => T_HEREDOC,
            T_NOWDOC => T_NOWDOC,
            T_END_HEREDOC => T_END_HEREDOC,
            T_END_NOWDOC => T_END_NOWDOC,
            T_DOUBLE_QUOTED_STRING => T_DOUBLE_QUOTED_STRING,
        ];
        $validTokens += Tokens::$emptyTokens;

        for (; $next <= $end; ++$next) {
            $token = $tokens[$next];
            $code = $token['code'];

            // Ignorable tokens.
            if (true === isset(Tokens::$emptyTokens[$code])) {
                continue;
            }

            if (false === $foundContent) {
                // A throw statement as the first content indicates an interface method.
                if (T_THROW === $code && false !== $implements) {
                    return;
                }

                // A return statement as the first content indicates an interface method.
                if (T_RETURN === $code) {
                    $tmp = $phpcsFile->findNext(Tokens::$emptyTokens, ($next + 1), null, true);
                    if (false === $tmp && false !== $implements) {
                        return;
                    }

                    // There is a return.
                    if (T_SEMICOLON === $tokens[$tmp]['code'] && false !== $implements) {
                        return;
                    }

                    $tmp = $phpcsFile->findNext(Tokens::$emptyTokens, ($tmp + 1), null, true);
                    if (false !== $tmp && T_SEMICOLON === $tokens[$tmp]['code'] && false !== $implements) {
                        // There is a return <token>.
                        return;
                    }
                }//end if
            }//end if

            $foundContent = true;

            if (T_VARIABLE === $code && true === isset($params[$token['content']])) {
                unset($params[$token['content']]);
            } elseif (T_DOLLAR === $code) {
                $nextToken = $phpcsFile->findNext(T_WHITESPACE, ($next + 1), null, true);
                if (T_OPEN_CURLY_BRACKET === $tokens[$nextToken]['code']) {
                    $nextToken = $phpcsFile->findNext(T_WHITESPACE, ($nextToken + 1), null, true);
                    if (T_STRING === $tokens[$nextToken]['code']) {
                        $varContent = '$' . $tokens[$nextToken]['content'];
                        if (true === isset($params[$varContent])) {
                            unset($params[$varContent]);
                        }
                    }
                }
            } elseif (T_DOUBLE_QUOTED_STRING === $code
                || T_START_HEREDOC === $code
                || T_START_NOWDOC === $code
            ) {
                // Tokenize strings that can contain variables.
                // Make sure the string is re-joined if it occurs over multiple lines.
                $content = $token['content'];
                for ($i = ($next + 1); $i <= $end; ++$i) {
                    if (true === isset($validTokens[$tokens[$i]['code']])) {
                        $content .= $tokens[$i]['content'];
                        ++$next;
                    } else {
                        break;
                    }
                }

                $stringTokens = token_get_all(sprintf('<?php %s;?>', $content));
                foreach ($stringTokens as $stringPtr => $stringToken) {
                    if (false === \is_array($stringToken)) {
                        continue;
                    }

                    $varContent = '';
                    if (T_DOLLAR_OPEN_CURLY_BRACES === $stringToken[0]) {
                        $varContent = '$' . $stringTokens[($stringPtr + 1)][1];
                    } elseif (T_VARIABLE === $stringToken[0]) {
                        $varContent = $stringToken[1];
                    }

                    if ('' !== $varContent && true === isset($params[$varContent])) {
                        unset($params[$varContent]);
                    }
                }
            }//end if
        }//end for

        if (true === $foundContent && \count($params) > 0) {
            $error = 'The method parameter %s is never used';

            // If there is only one parameter and it is unused, no need for additional errorcode toggling logic.
            if (1 === $methodParamsCount) {
                foreach ($params as $paramName => $position) {
                    $data = [$paramName];
                    $phpcsFile->addWarning($error, $position, $errorCode, $data);
                }

                return;
            }

            $foundLastUsed = false;
            $lastIndex = ($methodParamsCount - 1);
            $errorInfo = [];
            for ($i = $lastIndex; $i >= 0; --$i) {
                if (false !== $foundLastUsed) {
                    if (true === isset($params[$methodParams[$i]['name']])) {
                        $errorInfo[$methodParams[$i]['name']] = [
                            'position' => $params[$methodParams[$i]['name']],
                            'errorcode' => $errorCode . 'BeforeLastUsed',
                        ];
                    }
                } else {
                    if (false === isset($params[$methodParams[$i]['name']])) {
                        $foundLastUsed = true;
                    } else {
                        $errorInfo[$methodParams[$i]['name']] = [
                            'position' => $params[$methodParams[$i]['name']],
                            'errorcode' => $errorCode . 'AfterLastUsed',
                        ];
                    }
                }
            }

            if (\count($errorInfo) > 0) {
                $errorInfo = array_reverse($errorInfo);
                foreach ($errorInfo as $paramName => $info) {
                    $data = [$paramName];
                    $phpcsFile->addWarning($error, $info['position'], $info['errorcode'], $data);
                }
            }
        }//end if
    }

    //end process()
}//end class
