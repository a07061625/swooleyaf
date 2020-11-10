<?php
/**
 * Processes pattern strings and checks that the code conforms to the pattern.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Sniffs;

use PHP_CodeSniffer\Exceptions\RuntimeException;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Tokenizers\PHP;
use PHP_CodeSniffer\Util\Tokens;

abstract class AbstractPatternSniff implements Sniff
{
    /**
     * If true, comments will be ignored if they are found in the code.
     *
     * @var bool
     */
    public $ignoreComments = false;

    /**
     * The current file being checked.
     *
     * @var string
     */
    protected $currFile = '';

    /**
     * The parsed patterns array.
     *
     * @var array
     */
    private $parsedPatterns = [];

    /**
     * Tokens that this sniff wishes to process outside of the patterns.
     *
     * @var int[]
     *
     * @see registerSupplementary()
     * @see processSupplementary()
     */
    private $supplementaryTokens = [];

    /**
     * Positions in the stack where errors have occurred.
     *
     * @var array<int, bool>
     */
    private $errorPos = [];

    /**
     * Constructs a AbstractPatternSniff.
     *
     * @param bool $ignoreComments If true, comments will be ignored.
     */
    public function __construct($ignoreComments = null)
    {
        // This is here for backwards compatibility.
        if (null !== $ignoreComments) {
            $this->ignoreComments = $ignoreComments;
        }

        $this->supplementaryTokens = $this->registerSupplementary();
    }

    //end __construct()

    /**
     * Registers the tokens to listen to.
     *
     * Classes extending <i>AbstractPatternTest</i> should implement the
     * <i>getPatterns()</i> method to register the patterns they wish to test.
     *
     * @return int[]
     *
     * @see    process()
     */
    final public function register()
    {
        $listenTypes = [];
        $patterns = $this->getPatterns();

        foreach ($patterns as $pattern) {
            $parsedPattern = $this->parse($pattern);

            // Find a token position in the pattern that we can use
            // for a listener token.
            $pos = $this->getListenerTokenPos($parsedPattern);
            $tokenType = $parsedPattern[$pos]['token'];
            $listenTypes[] = $tokenType;

            $patternArray = [
                'listen_pos' => $pos,
                'pattern' => $parsedPattern,
                'pattern_code' => $pattern,
            ];

            if (false === isset($this->parsedPatterns[$tokenType])) {
                $this->parsedPatterns[$tokenType] = [];
            }

            $this->parsedPatterns[$tokenType][] = $patternArray;
        }//end foreach

        return array_unique(array_merge($listenTypes, $this->supplementaryTokens));
    }

    //end register()

    /**
     * Processes the test.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The PHP_CodeSniffer file where the
     *                                               token occurred.
     * @param int                         $stackPtr  The position in the tokens stack
     *                                               where the listening token type
     *                                               was found.
     *
     * @see    register()
     */
    final public function process(File $phpcsFile, $stackPtr)
    {
        $file = $phpcsFile->getFilename();
        if ($this->currFile !== $file) {
            // We have changed files, so clean up.
            $this->errorPos = [];
            $this->currFile = $file;
        }

        $tokens = $phpcsFile->getTokens();

        if (true === \in_array($tokens[$stackPtr]['code'], $this->supplementaryTokens, true)) {
            $this->processSupplementary($phpcsFile, $stackPtr);
        }

        $type = $tokens[$stackPtr]['code'];

        // If the type is not set, then it must have been a token registered
        // with registerSupplementary().
        if (false === isset($this->parsedPatterns[$type])) {
            return;
        }

        $allErrors = [];

        // Loop over each pattern that is listening to the current token type
        // that we are processing.
        foreach ($this->parsedPatterns[$type] as $patternInfo) {
            // If processPattern returns false, then the pattern that we are
            // checking the code with must not be designed to check that code.
            $errors = $this->processPattern($patternInfo, $phpcsFile, $stackPtr);
            if (false === $errors) {
                // The pattern didn't match.
                continue;
            }
            if (true === empty($errors)) {
                // The pattern matched, but there were no errors.
                break;
            }

            foreach ($errors as $stackPtr => $error) {
                if (false === isset($this->errorPos[$stackPtr])) {
                    $this->errorPos[$stackPtr] = true;
                    $allErrors[$stackPtr] = $error;
                }
            }
        }

        foreach ($allErrors as $stackPtr => $error) {
            $phpcsFile->addError($error, $stackPtr, 'Found');
        }
    }

    //end process()

    /**
     * Processes the pattern and verifies the code at $stackPtr.
     *
     * @param array                       $patternInfo Information about the pattern used
     *                                                 for checking, which includes are
     *                                                 parsed token representation of the
     *                                                 pattern.
     * @param \PHP_CodeSniffer\Files\File $phpcsFile   The PHP_CodeSniffer file where the
     *                                                 token occurred.
     * @param int                         $stackPtr    The position in the tokens stack where
     *                                                 the listening token type was found.
     *
     * @return array
     */
    protected function processPattern($patternInfo, File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $pattern = $patternInfo['pattern'];
        $patternCode = $patternInfo['pattern_code'];
        $errors = [];
        $found = '';

        $ignoreTokens = [T_WHITESPACE => T_WHITESPACE];
        if (true === $this->ignoreComments) {
            $ignoreTokens += Tokens::$commentTokens;
        }

        $origStackPtr = $stackPtr;
        $hasError = false;

        if ($patternInfo['listen_pos'] > 0) {
            --$stackPtr;

            for ($i = ($patternInfo['listen_pos'] - 1); $i >= 0; --$i) {
                if ('token' === $pattern[$i]['type']) {
                    if (T_WHITESPACE === $pattern[$i]['token']) {
                        if (T_WHITESPACE === $tokens[$stackPtr]['code']) {
                            $found = $tokens[$stackPtr]['content'] . $found;
                        }

                        // Only check the size of the whitespace if this is not
                        // the first token. We don't care about the size of
                        // leading whitespace, just that there is some.
                        if (0 !== $i) {
                            if ($tokens[$stackPtr]['content'] !== $pattern[$i]['value']) {
                                $hasError = true;
                            }
                        }
                    } else {
                        // Check to see if this important token is the same as the
                        // previous important token in the pattern. If it is not,
                        // then the pattern cannot be for this piece of code.
                        $prev = $phpcsFile->findPrevious(
                            $ignoreTokens,
                            $stackPtr,
                            null,
                            true
                        );

                        if (false === $prev
                            || $tokens[$prev]['code'] !== $pattern[$i]['token']
                        ) {
                            return false;
                        }

                        // If we skipped past some whitespace tokens, then add them
                        // to the found string.
                        $tokenContent = $phpcsFile->getTokensAsString(
                            ($prev + 1),
                            ($stackPtr - $prev - 1)
                        );

                        $found = $tokens[$prev]['content'] . $tokenContent . $found;

                        if (true === isset($pattern[($i - 1)])
                            && 'skip' === $pattern[($i - 1)]['type']
                        ) {
                            $stackPtr = $prev;
                        } else {
                            $stackPtr = ($prev - 1);
                        }
                    }//end if
                } elseif ('skip' === $pattern[$i]['type']) {
                    // Skip to next piece of relevant code.
                    if ('parenthesis_closer' === $pattern[$i]['to']) {
                        $to = 'parenthesis_opener';
                    } else {
                        $to = 'scope_opener';
                    }

                    // Find the previous opener.
                    $next = $phpcsFile->findPrevious(
                        $ignoreTokens,
                        $stackPtr,
                        null,
                        true
                    );

                    if (false === $next || false === isset($tokens[$next][$to])) {
                        // If there was not opener, then we must be
                        // using the wrong pattern.
                        return false;
                    }

                    if ('parenthesis_opener' === $to) {
                        $found = '{' . $found;
                    } else {
                        $found = '(' . $found;
                    }

                    $found = '...' . $found;

                    // Skip to the opening token.
                    $stackPtr = ($tokens[$next][$to] - 1);
                } elseif ('string' === $pattern[$i]['type']) {
                    $found = 'abc';
                } elseif ('newline' === $pattern[$i]['type']) {
                    if (true === $this->ignoreComments
                        && true === isset(Tokens::$commentTokens[$tokens[$stackPtr]['code']])
                    ) {
                        $startComment = $phpcsFile->findPrevious(
                            Tokens::$commentTokens,
                            ($stackPtr - 1),
                            null,
                            true
                        );

                        if ($tokens[$startComment]['line'] !== $tokens[($startComment + 1)]['line']) {
                            ++$startComment;
                        }

                        $tokenContent = $phpcsFile->getTokensAsString(
                            $startComment,
                            ($stackPtr - $startComment + 1)
                        );

                        $found = $tokenContent . $found;
                        $stackPtr = ($startComment - 1);
                    }

                    if (T_WHITESPACE === $tokens[$stackPtr]['code']) {
                        if ($tokens[$stackPtr]['content'] !== $phpcsFile->eolChar) {
                            $found = $tokens[$stackPtr]['content'] . $found;

                            // This may just be an indent that comes after a newline
                            // so check the token before to make sure. If it is a newline, we
                            // can ignore the error here.
                            if (($tokens[($stackPtr - 1)]['content'] !== $phpcsFile->eolChar)
                                && (true === $this->ignoreComments
                                && false === isset(Tokens::$commentTokens[$tokens[($stackPtr - 1)]['code']]))
                            ) {
                                $hasError = true;
                            } else {
                                --$stackPtr;
                            }
                        } else {
                            $found = 'EOL' . $found;
                        }
                    } else {
                        $found = $tokens[$stackPtr]['content'] . $found;
                        $hasError = true;
                    }//end if

                    if (false === $hasError && 'newline' !== $pattern[($i - 1)]['type']) {
                        // Make sure they only have 1 newline.
                        $prev = $phpcsFile->findPrevious($ignoreTokens, ($stackPtr - 1), null, true);
                        if (false !== $prev && $tokens[$prev]['line'] !== $tokens[$stackPtr]['line']) {
                            $hasError = true;
                        }
                    }
                }//end if
            }//end for
        }//end if

        $stackPtr = $origStackPtr;
        $lastAddedStackPtr = null;
        $patternLen = \count($pattern);

        for ($i = $patternInfo['listen_pos']; $i < $patternLen; ++$i) {
            if (false === isset($tokens[$stackPtr])) {
                break;
            }

            if ('token' === $pattern[$i]['type']) {
                if (T_WHITESPACE === $pattern[$i]['token']) {
                    if (true === $this->ignoreComments) {
                        // If we are ignoring comments, check to see if this current
                        // token is a comment. If so skip it.
                        if (true === isset(Tokens::$commentTokens[$tokens[$stackPtr]['code']])) {
                            continue;
                        }

                        // If the next token is a comment, the we need to skip the
                        // current token as we should allow a space before a
                        // comment for readability.
                        if (true === isset($tokens[($stackPtr + 1)])
                            && true === isset(Tokens::$commentTokens[$tokens[($stackPtr + 1)]['code']])
                        ) {
                            continue;
                        }
                    }

                    $tokenContent = '';
                    if (T_WHITESPACE === $tokens[$stackPtr]['code']) {
                        if (false === isset($pattern[($i + 1)])) {
                            // This is the last token in the pattern, so just compare
                            // the next token of content.
                            $tokenContent = $tokens[$stackPtr]['content'];
                        } else {
                            // Get all the whitespace to the next token.
                            $next = $phpcsFile->findNext(
                                Tokens::$emptyTokens,
                                $stackPtr,
                                null,
                                true
                            );

                            $tokenContent = $phpcsFile->getTokensAsString(
                                $stackPtr,
                                ($next - $stackPtr)
                            );

                            $lastAddedStackPtr = $stackPtr;
                            $stackPtr = $next;
                        }//end if

                        if ($stackPtr !== $lastAddedStackPtr) {
                            $found .= $tokenContent;
                        }
                    } else {
                        if ($stackPtr !== $lastAddedStackPtr) {
                            $found .= $tokens[$stackPtr]['content'];
                            $lastAddedStackPtr = $stackPtr;
                        }
                    }//end if

                    if (true === isset($pattern[($i + 1)])
                        && 'skip' === $pattern[($i + 1)]['type']
                    ) {
                        // The next token is a skip token, so we just need to make
                        // sure the whitespace we found has *at least* the
                        // whitespace required.
                        if (0 !== strpos($tokenContent, $pattern[$i]['value'])) {
                            $hasError = true;
                        }
                    } else {
                        if ($tokenContent !== $pattern[$i]['value']) {
                            $hasError = true;
                        }
                    }
                } else {
                    // Check to see if this important token is the same as the
                    // next important token in the pattern. If it is not, then
                    // the pattern cannot be for this piece of code.
                    $next = $phpcsFile->findNext(
                        $ignoreTokens,
                        $stackPtr,
                        null,
                        true
                    );

                    if (false === $next
                        || $tokens[$next]['code'] !== $pattern[$i]['token']
                    ) {
                        // The next important token did not match the pattern.
                        return false;
                    }

                    if (null !== $lastAddedStackPtr) {
                        if ((T_OPEN_CURLY_BRACKET === $tokens[$next]['code']
                            || T_CLOSE_CURLY_BRACKET === $tokens[$next]['code'])
                            && true === isset($tokens[$next]['scope_condition'])
                            && $tokens[$next]['scope_condition'] > $lastAddedStackPtr
                        ) {
                            // This is a brace, but the owner of it is after the current
                            // token, which means it does not belong to any token in
                            // our pattern. This means the pattern is not for us.
                            return false;
                        }

                        if ((T_OPEN_PARENTHESIS === $tokens[$next]['code']
                            || T_CLOSE_PARENTHESIS === $tokens[$next]['code'])
                            && true === isset($tokens[$next]['parenthesis_owner'])
                            && $tokens[$next]['parenthesis_owner'] > $lastAddedStackPtr
                        ) {
                            // This is a bracket, but the owner of it is after the current
                            // token, which means it does not belong to any token in
                            // our pattern. This means the pattern is not for us.
                            return false;
                        }
                    }//end if

                    // If we skipped past some whitespace tokens, then add them
                    // to the found string.
                    if (($next - $stackPtr) > 0) {
                        $hasComment = false;
                        for ($j = $stackPtr; $j < $next; ++$j) {
                            $found .= $tokens[$j]['content'];
                            if (true === isset(Tokens::$commentTokens[$tokens[$j]['code']])) {
                                $hasComment = true;
                            }
                        }

                        // If we are not ignoring comments, this additional
                        // whitespace or comment is not allowed. If we are
                        // ignoring comments, there needs to be at least one
                        // comment for this to be allowed.
                        if (false === $this->ignoreComments
                            || (true === $this->ignoreComments
                            && false === $hasComment)
                        ) {
                            $hasError = true;
                        }

                        // Even when ignoring comments, we are not allowed to include
                        // newlines without the pattern specifying them, so
                        // everything should be on the same line.
                        if ($tokens[$next]['line'] !== $tokens[$stackPtr]['line']) {
                            $hasError = true;
                        }
                    }//end if

                    if ($next !== $lastAddedStackPtr) {
                        $found .= $tokens[$next]['content'];
                        $lastAddedStackPtr = $next;
                    }

                    if (true === isset($pattern[($i + 1)])
                        && 'skip' === $pattern[($i + 1)]['type']
                    ) {
                        $stackPtr = $next;
                    } else {
                        $stackPtr = ($next + 1);
                    }
                }//end if
            } elseif ('skip' === $pattern[$i]['type']) {
                if ('unknown' === $pattern[$i]['to']) {
                    $next = $phpcsFile->findNext(
                        $pattern[($i + 1)]['token'],
                        $stackPtr
                    );

                    if (false === $next) {
                        // Couldn't find the next token, so we must
                        // be using the wrong pattern.
                        return false;
                    }

                    $found .= '...';
                    $stackPtr = $next;
                } else {
                    // Find the previous opener.
                    $next = $phpcsFile->findPrevious(
                        Tokens::$blockOpeners,
                        $stackPtr
                    );

                    if (false === $next
                        || false === isset($tokens[$next][$pattern[$i]['to']])
                    ) {
                        // If there was not opener, then we must
                        // be using the wrong pattern.
                        return false;
                    }

                    $found .= '...';
                    if ('parenthesis_closer' === $pattern[$i]['to']) {
                        $found .= ')';
                    } else {
                        $found .= '}';
                    }

                    // Skip to the closing token.
                    $stackPtr = ($tokens[$next][$pattern[$i]['to']] + 1);
                }//end if
            } elseif ('string' === $pattern[$i]['type']) {
                if (T_STRING !== $tokens[$stackPtr]['code']) {
                    $hasError = true;
                }

                if ($stackPtr !== $lastAddedStackPtr) {
                    $found .= 'abc';
                    $lastAddedStackPtr = $stackPtr;
                }

                ++$stackPtr;
            } elseif ('newline' === $pattern[$i]['type']) {
                // Find the next token that contains a newline character.
                $newline = 0;
                for ($j = $stackPtr; $j < $phpcsFile->numTokens; ++$j) {
                    if (false !== strpos($tokens[$j]['content'], $phpcsFile->eolChar)) {
                        $newline = $j;

                        break;
                    }
                }

                if (0 === $newline) {
                    // We didn't find a newline character in the rest of the file.
                    $next = ($phpcsFile->numTokens - 1);
                    $hasError = true;
                } else {
                    if (false === $this->ignoreComments) {
                        // The newline character cannot be part of a comment.
                        if (true === isset(Tokens::$commentTokens[$tokens[$newline]['code']])) {
                            $hasError = true;
                        }
                    }

                    if ($newline === $stackPtr) {
                        $next = ($stackPtr + 1);
                    } else {
                        // Check that there were no significant tokens that we
                        // skipped over to find our newline character.
                        $next = $phpcsFile->findNext(
                            $ignoreTokens,
                            $stackPtr,
                            null,
                            true
                        );

                        if ($next < $newline) {
                            // We skipped a non-ignored token.
                            $hasError = true;
                        } else {
                            $next = ($newline + 1);
                        }
                    }
                }//end if

                if ($stackPtr !== $lastAddedStackPtr) {
                    $found .= $phpcsFile->getTokensAsString(
                        $stackPtr,
                        ($next - $stackPtr)
                    );

                    $lastAddedStackPtr = ($next - 1);
                }

                $stackPtr = $next;
            }//end if
        }//end for

        if (true === $hasError) {
            $error = $this->prepareError($found, $patternCode);
            $errors[$origStackPtr] = $error;
        }

        return $errors;
    }

    //end processPattern()

    /**
     * Prepares an error for the specified patternCode.
     *
     * @param string $found       The actual found string in the code.
     * @param string $patternCode The expected pattern code.
     *
     * @return string The error message.
     */
    protected function prepareError($found, $patternCode)
    {
        $found = str_replace("\r\n", '\n', $found);
        $found = str_replace("\n", '\n', $found);
        $found = str_replace("\r", '\n', $found);
        $found = str_replace("\t", '\t', $found);
        $found = str_replace('EOL', '\n', $found);
        $expected = str_replace('EOL', '\n', $patternCode);

        return "Expected \"{$expected}\"; found \"{$found}\"";
    }

    //end prepareError()

    /**
     * Returns the patterns that should be checked.
     *
     * @return string[]
     */
    abstract protected function getPatterns();

    /**
     * Registers any supplementary tokens that this test might wish to process.
     *
     * A sniff may wish to register supplementary tests when it wishes to group
     * an arbitrary validation that cannot be performed using a pattern, with
     * other pattern tests.
     *
     * @return int[]
     *
     * @see    processSupplementary()
     */
    protected function registerSupplementary()
    {
        return [];
    }

    //end registerSupplementary()

    /**
     * Processes any tokens registered with registerSupplementary().
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The PHP_CodeSniffer file where to
     *                                               process the skip.
     * @param int                         $stackPtr  The position in the tokens stack to
     *                                               process.
     *
     * @see    registerSupplementary()
     */
    protected function processSupplementary(File $phpcsFile, $stackPtr)
    {
    }

    //end processSupplementary()

    /**
     * Returns the token types that the specified pattern is checking for.
     *
     * Returned array is in the format:
     * <code>
     *   array(
     *      T_WHITESPACE => 0, // 0 is the position where the T_WHITESPACE token
     *                         // should occur in the pattern.
     *   );
     * </code>
     *
     * @param array $pattern The parsed pattern to find the acquire the token
     *                       types from.
     *
     * @return array<int, int>
     */
    private function getPatternTokenTypes($pattern)
    {
        $tokenTypes = [];
        foreach ($pattern as $pos => $patternInfo) {
            if ('token' === $patternInfo['type']) {
                if (false === isset($tokenTypes[$patternInfo['token']])) {
                    $tokenTypes[$patternInfo['token']] = $pos;
                }
            }
        }

        return $tokenTypes;
    }

    //end getPatternTokenTypes()

    /**
     * Returns the position in the pattern that this test should register as
     * a listener for the pattern.
     *
     * @param array $pattern The pattern to acquire the listener for.
     *
     * @return int The position in the pattern that this test should register
     *             as the listener.
     *
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException If we could not determine a token to listen for.
     */
    private function getListenerTokenPos($pattern)
    {
        $tokenTypes = $this->getPatternTokenTypes($pattern);
        $tokenCodes = array_keys($tokenTypes);
        $token = Tokens::getHighestWeightedToken($tokenCodes);

        // If we could not get a token.
        if (false === $token) {
            $error = 'Could not determine a token to listen for';

            throw new RuntimeException($error);
        }

        return $tokenTypes[$token];
    }

    //end getListenerTokenPos()

    /**
     * Parses a pattern string into an array of pattern steps.
     *
     * @param string $pattern The pattern to parse.
     *
     * @return array The parsed pattern array.
     *
     * @see    createSkipPattern()
     * @see    createTokenPattern()
     */
    private function parse($pattern)
    {
        $patterns = [];
        $length = \strlen($pattern);
        $lastToken = 0;
        $firstToken = 0;

        for ($i = 0; $i < $length; ++$i) {
            $specialPattern = false;
            $isLastChar = ($i === ($length - 1));
            $oldFirstToken = $firstToken;

            if ('...' === substr($pattern, $i, 3)) {
                // It's a skip pattern. The skip pattern requires the
                // content of the token in the "from" position and the token
                // to skip to.
                $specialPattern = $this->createSkipPattern($pattern, ($i - 1));
                $lastToken = ($i - $firstToken);
                $firstToken = ($i + 3);
                $i += 2;

                if ('unknown' !== $specialPattern['to']) {
                    ++$firstToken;
                }
            } elseif ('abc' === substr($pattern, $i, 3)) {
                $specialPattern = ['type' => 'string'];
                $lastToken = ($i - $firstToken);
                $firstToken = ($i + 3);
                $i += 2;
            } elseif ('EOL' === substr($pattern, $i, 3)) {
                $specialPattern = ['type' => 'newline'];
                $lastToken = ($i - $firstToken);
                $firstToken = ($i + 3);
                $i += 2;
            }//end if

            if (false !== $specialPattern || true === $isLastChar) {
                // If we are at the end of the string, don't worry about a limit.
                if (true === $isLastChar) {
                    // Get the string from the end of the last skip pattern, if any,
                    // to the end of the pattern string.
                    $str = substr($pattern, $oldFirstToken);
                } else {
                    // Get the string from the end of the last special pattern,
                    // if any, to the start of this special pattern.
                    if (0 === $lastToken) {
                        // Note that if the last special token was zero characters ago,
                        // there will be nothing to process so we can skip this bit.
                        // This happens if you have something like: EOL... in your pattern.
                        $str = '';
                    } else {
                        $str = substr($pattern, $oldFirstToken, $lastToken);
                    }
                }

                if ('' !== $str) {
                    $tokenPatterns = $this->createTokenPattern($str);
                    foreach ($tokenPatterns as $tokenPattern) {
                        $patterns[] = $tokenPattern;
                    }
                }

                // Make sure we don't skip the last token.
                if (false === $isLastChar && $i === ($length - 1)) {
                    --$i;
                }
            }//end if

            // Add the skip pattern *after* we have processed
            // all the tokens from the end of the last skip pattern
            // to the start of this skip pattern.
            if (false !== $specialPattern) {
                $patterns[] = $specialPattern;
            }
        }//end for

        return $patterns;
    }

    //end parse()

    /**
     * Creates a skip pattern.
     *
     * @param string $pattern The pattern being parsed.
     * @param string $from    The token content that the skip pattern starts from.
     *
     * @return array The pattern step.
     *
     * @see    createTokenPattern()
     * @see    parse()
     */
    private function createSkipPattern($pattern, $from)
    {
        $skip = ['type' => 'skip'];

        $nestedParenthesis = 0;
        $nestedBraces = 0;
        for ($start = $from; $start >= 0; --$start) {
            switch ($pattern[$start]) {
            case '(':
                if (0 === $nestedParenthesis) {
                    $skip['to'] = 'parenthesis_closer';
                }

                --$nestedParenthesis;

                break;
            case '{':
                if (0 === $nestedBraces) {
                    $skip['to'] = 'scope_closer';
                }

                --$nestedBraces;

                break;
            case '}':
                $nestedBraces++;

                break;
            case ')':
                $nestedParenthesis++;

                break;
            }//end switch

            if (true === isset($skip['to'])) {
                break;
            }
        }//end for

        if (false === isset($skip['to'])) {
            $skip['to'] = 'unknown';
        }

        return $skip;
    }

    //end createSkipPattern()

    /**
     * Creates a token pattern.
     *
     * @param string $str The tokens string that the pattern should match.
     *
     * @return array The pattern step.
     *
     * @see    createSkipPattern()
     * @see    parse()
     */
    private function createTokenPattern($str)
    {
        // Don't add a space after the closing php tag as it will add a new
        // whitespace token.
        $tokenizer = new PHP('<?php ' . $str . '?>', null);

        // Remove the <?php tag from the front and the end php tag from the back.
        $tokens = $tokenizer->getTokens();
        $tokens = \array_slice($tokens, 1, (\count($tokens) - 2));

        $patterns = [];
        foreach ($tokens as $patternInfo) {
            $patterns[] = [
                'type' => 'token',
                'token' => $patternInfo['code'],
                'value' => $patternInfo['content'],
            ];
        }

        return $patterns;
    }

    //end createTokenPattern()
}//end class
