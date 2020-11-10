<?php
/**
 * The base tokenizer class.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tokenizers;

use PHP_CodeSniffer\Exceptions\TokenizerException;
use PHP_CodeSniffer\Util;

abstract class Tokenizer
{
    /**
     * A list of tokens that are allowed to open a scope.
     *
     * @var array
     */
    public $scopeOpeners = [];

    /**
     * A list of tokens that end the scope.
     *
     * @var array
     */
    public $endScopeTokens = [];

    /**
     * Known lengths of tokens.
     *
     * @var array<int, int>
     */
    public $knownLengths = [];

    /**
     * A list of lines being ignored due to error suppression comments.
     *
     * @var array
     */
    public $ignoredLines = [];

    /**
     * The config data for the run.
     *
     * @var \PHP_CodeSniffer\Config
     */
    protected $config;

    /**
     * The EOL char used in the content.
     *
     * @var string
     */
    protected $eolChar = [];

    /**
     * A token-based representation of the content.
     *
     * @var array
     */
    protected $tokens = [];

    /**
     * The number of tokens in the tokens array.
     *
     * @var int
     */
    protected $numTokens = 0;

    /**
     * Initialise and run the tokenizer.
     *
     * @param string                         $content The content to tokenize,
     * @param \PHP_CodeSniffer\Config | null $config  The config data for the run.
     * @param string                         $eolChar The EOL char used in the content.
     *
     * @throws \PHP_CodeSniffer\Exceptions\TokenizerException If the file appears to be minified.
     */
    public function __construct($content, $config, $eolChar = '\n')
    {
        $this->eolChar = $eolChar;

        $this->config = $config;
        $this->tokens = $this->tokenize($content);

        if (null === $config) {
            return;
        }

        $this->createPositionMap();
        $this->createTokenMap();
        $this->createParenthesisNestingMap();
        $this->createScopeMap();
        $this->createLevelMap();

        // Allow the tokenizer to do additional processing if required.
        $this->processAdditional();
    }

    //end __construct()

    /**
     * Gets the array of tokens.
     *
     * @return array
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    //end getTokens()

    /**
     * Replaces tabs in original token content with spaces.
     *
     * Each tab can represent between 1 and $config->tabWidth spaces,
     * so this cannot be a straight string replace. The original content
     * is placed into an orig_content index and the new token length is also
     * set in the length index.
     *
     * @param array  $token    The token to replace tabs inside.
     * @param string $prefix   The character to use to represent the start of a tab.
     * @param string $padding  The character to use to represent the end of a tab.
     * @param int    $tabWidth The number of spaces each tab represents.
     */
    public function replaceTabsInToken(&$token, $prefix = ' ', $padding = ' ', $tabWidth = null)
    {
        $checkEncoding = false;
        if (true === \function_exists('iconv_strlen')) {
            $checkEncoding = true;
        }

        $currColumn = $token['column'];
        if (null === $tabWidth) {
            $tabWidth = $this->config->tabWidth;
            if (0 === $tabWidth) {
                $tabWidth = 1;
            }
        }

        if ('' === rtrim($token['content'], "\t")) {
            // String only contains tabs, so we can shortcut the process.
            $numTabs = \strlen($token['content']);

            $firstTabSize = ($tabWidth - (($currColumn - 1) % $tabWidth));
            $length = ($firstTabSize + ($tabWidth * ($numTabs - 1)));
            $newContent = $prefix . str_repeat($padding, ($length - 1));
        } else {
            // We need to determine the length of each tab.
            $tabs = explode("\t", $token['content']);

            $numTabs = (\count($tabs) - 1);
            $tabNum = 0;
            $newContent = '';
            $length = 0;

            foreach ($tabs as $content) {
                if ('' !== $content) {
                    $newContent .= $content;
                    if (true === $checkEncoding) {
                        // Not using the default encoding, so take a bit more care.
                        $oldLevel = error_reporting();
                        error_reporting(0);
                        $contentLength = iconv_strlen($content, $this->config->encoding);
                        error_reporting($oldLevel);
                        if (false === $contentLength) {
                            // String contained invalid characters, so revert to default.
                            $contentLength = \strlen($content);
                        }
                    } else {
                        $contentLength = \strlen($content);
                    }

                    $currColumn += $contentLength;
                    $length += $contentLength;
                }

                // The last piece of content does not have a tab after it.
                if ($tabNum === $numTabs) {
                    break;
                }

                // Process the tab that comes after the content.
                $lastCurrColumn = $currColumn;
                ++$tabNum;

                // Move the pointer to the next tab stop.
                if (($currColumn % $tabWidth) === 0) {
                    // This is the first tab, and we are already at a
                    // tab stop, so this tab counts as a single space.
                    ++$currColumn;
                } else {
                    ++$currColumn;
                    while (($currColumn % $tabWidth) !== 0) {
                        ++$currColumn;
                    }

                    ++$currColumn;
                }

                $length += ($currColumn - $lastCurrColumn);
                $newContent .= $prefix . str_repeat($padding, ($currColumn - $lastCurrColumn - 1));
            }//end foreach
        }//end if

        $token['orig_content'] = $token['content'];
        $token['content'] = $newContent;
        $token['length'] = $length;
    }

    //end replaceTabsInToken()

    /**
     * Checks the content to see if it looks minified.
     *
     * @param string $content The content to tokenize.
     * @param string $eolChar The EOL char used in the content.
     *
     * @return bool
     */
    protected function isMinifiedContent($content, $eolChar = '\n')
    {
        // Minified files often have a very large number of characters per line
        // and cause issues when tokenizing.
        $numChars = \strlen($content);
        $numLines = (substr_count($content, $eolChar) + 1);
        $average = ($numChars / $numLines);
        if ($average > 100) {
            return true;
        }

        return false;
    }

    //end isMinifiedContent()

    /**
     * Creates an array of tokens when given some content.
     *
     * @param string $string The string to tokenize.
     *
     * @return array
     */
    abstract protected function tokenize($string);

    /**
     * Performs additional processing after main tokenizing.
     */
    abstract protected function processAdditional();

    /**
     * Sets token position information.
     *
     * Can also convert tabs into spaces. Each tab can represent between
     * 1 and $width spaces, so this cannot be a straight string replace.
     */
    private function createPositionMap()
    {
        $currColumn = 1;
        $lineNumber = 1;
        $eolLen = \strlen($this->eolChar);
        $ignoring = null;
        $inTests = \defined('PHP_CODESNIFFER_IN_TESTS');

        $checkEncoding = false;
        if (true === \function_exists('iconv_strlen')) {
            $checkEncoding = true;
        }

        $checkAnnotations = $this->config->annotations;
        $encoding = $this->config->encoding;
        $tabWidth = $this->config->tabWidth;

        $tokensWithTabs = [
            T_WHITESPACE => true,
            T_COMMENT => true,
            T_DOC_COMMENT => true,
            T_DOC_COMMENT_WHITESPACE => true,
            T_DOC_COMMENT_STRING => true,
            T_CONSTANT_ENCAPSED_STRING => true,
            T_DOUBLE_QUOTED_STRING => true,
            T_HEREDOC => true,
            T_NOWDOC => true,
            T_INLINE_HTML => true,
        ];

        $this->numTokens = \count($this->tokens);
        for ($i = 0; $i < $this->numTokens; ++$i) {
            $this->tokens[$i]['line'] = $lineNumber;
            $this->tokens[$i]['column'] = $currColumn;

            if (true === isset($this->knownLengths[$this->tokens[$i]['code']])) {
                // There are no tabs in the tokens we know the length of.
                $length = $this->knownLengths[$this->tokens[$i]['code']];
                $currColumn += $length;
            } elseif (0 === $tabWidth
                || false === isset($tokensWithTabs[$this->tokens[$i]['code']])
                || false === strpos($this->tokens[$i]['content'], "\t")
            ) {
                // There are no tabs in this content, or we aren't replacing them.
                if (true === $checkEncoding) {
                    // Not using the default encoding, so take a bit more care.
                    $oldLevel = error_reporting();
                    error_reporting(0);
                    $length = iconv_strlen($this->tokens[$i]['content'], $encoding);
                    error_reporting($oldLevel);

                    if (false === $length) {
                        // String contained invalid characters, so revert to default.
                        $length = \strlen($this->tokens[$i]['content']);
                    }
                } else {
                    $length = \strlen($this->tokens[$i]['content']);
                }

                $currColumn += $length;
            } else {
                $this->replaceTabsInToken($this->tokens[$i]);
                $length = $this->tokens[$i]['length'];
                $currColumn += $length;
            }//end if

            $this->tokens[$i]['length'] = $length;

            if (false === isset($this->knownLengths[$this->tokens[$i]['code']])
                && false !== strpos($this->tokens[$i]['content'], $this->eolChar)
            ) {
                ++$lineNumber;
                $currColumn = 1;

                // Newline chars are not counted in the token length.
                $this->tokens[$i]['length'] -= $eolLen;
            }

            if (T_COMMENT === $this->tokens[$i]['code']
                || T_DOC_COMMENT_STRING === $this->tokens[$i]['code']
                || T_DOC_COMMENT_TAG === $this->tokens[$i]['code']
                || (true === $inTests && T_INLINE_HTML === $this->tokens[$i]['code'])
            ) {
                $commentText = ltrim($this->tokens[$i]['content'], " \t/*");
                $commentText = rtrim($commentText, " */\t\r\n");
                $commentTextLower = strtolower($commentText);
                if (false !== strpos($commentText, '@codingStandards')) {
                    // If this comment is the only thing on the line, it tells us
                    // to ignore the following line. If the line contains other content
                    // then we are just ignoring this one single line.
                    $ownLine = false;
                    if ($i > 0) {
                        for ($prev = ($i - 1); $prev >= 0; --$prev) {
                            if (T_WHITESPACE === $this->tokens[$prev]['code']) {
                                continue;
                            }

                            break;
                        }

                        if ($this->tokens[$prev]['line'] !== $this->tokens[$i]['line']) {
                            $ownLine = true;
                        }
                    }

                    if (null === $ignoring
                        && false !== strpos($commentText, '@codingStandardsIgnoreStart')
                    ) {
                        $ignoring = ['.all' => true];
                        if (true === $ownLine) {
                            $this->ignoredLines[$this->tokens[$i]['line']] = $ignoring;
                        }
                    } elseif (null !== $ignoring
                        && false !== strpos($commentText, '@codingStandardsIgnoreEnd')
                    ) {
                        if (true === $ownLine) {
                            $this->ignoredLines[$this->tokens[$i]['line']] = ['.all' => true];
                        } else {
                            $this->ignoredLines[$this->tokens[$i]['line']] = $ignoring;
                        }

                        $ignoring = null;
                    } elseif (null === $ignoring
                        && false !== strpos($commentText, '@codingStandardsIgnoreLine')
                    ) {
                        $ignoring = ['.all' => true];
                        if (true === $ownLine) {
                            $this->ignoredLines[$this->tokens[$i]['line']] = $ignoring;
                            $this->ignoredLines[($this->tokens[$i]['line'] + 1)] = $ignoring;
                        } else {
                            $this->ignoredLines[$this->tokens[$i]['line']] = $ignoring;
                        }

                        $ignoring = null;
                    }//end if
                } elseif ('phpcs:' === substr($commentTextLower, 0, 6)
                    || '@phpcs:' === substr($commentTextLower, 0, 7)
                ) {
                    // If the @phpcs: syntax is being used, strip the @ to make
                    // comparisons easier.
                    if ('@' === $commentText[0]) {
                        $commentText = substr($commentText, 1);
                        $commentTextLower = strtolower($commentText);
                    }

                    // If there is a comment on the end, strip it off.
                    $commentStart = strpos($commentTextLower, ' --');
                    if (false !== $commentStart) {
                        $commentText = substr($commentText, 0, $commentStart);
                        $commentTextLower = strtolower($commentText);
                    }

                    // If this comment is the only thing on the line, it tells us
                    // to ignore the following line. If the line contains other content
                    // then we are just ignoring this one single line.
                    $lineHasOtherContent = false;
                    $lineHasOtherTokens = false;
                    if ($i > 0) {
                        for ($prev = ($i - 1); $prev > 0; --$prev) {
                            if ($this->tokens[$prev]['line'] !== $this->tokens[$i]['line']) {
                                // Changed lines.
                                break;
                            }

                            if (T_WHITESPACE === $this->tokens[$prev]['code']
                                || T_DOC_COMMENT_WHITESPACE === $this->tokens[$prev]['code']
                                || (T_INLINE_HTML === $this->tokens[$prev]['code']
                                && '' === trim($this->tokens[$prev]['content']))
                            ) {
                                continue;
                            }

                            $lineHasOtherTokens = true;

                            if (T_OPEN_TAG === $this->tokens[$prev]['code']
                                || T_DOC_COMMENT_STAR === $this->tokens[$prev]['code']
                            ) {
                                continue;
                            }

                            $lineHasOtherContent = true;

                            break;
                        }//end for

                        $changedLines = false;
                        for ($next = $i; $next < $this->numTokens; ++$next) {
                            if (true === $changedLines) {
                                // Changed lines.
                                break;
                            }

                            if (false === isset($this->knownLengths[$this->tokens[$next]['code']])
                                && false !== strpos($this->tokens[$next]['content'], $this->eolChar)
                            ) {
                                // Last token on the current line.
                                $changedLines = true;
                            }

                            if ($next === $i) {
                                continue;
                            }

                            if (T_WHITESPACE === $this->tokens[$next]['code']
                                || T_DOC_COMMENT_WHITESPACE === $this->tokens[$next]['code']
                                || (T_INLINE_HTML === $this->tokens[$next]['code']
                                && '' === trim($this->tokens[$next]['content']))
                            ) {
                                continue;
                            }

                            $lineHasOtherTokens = true;

                            if (T_CLOSE_TAG === $this->tokens[$next]['code']) {
                                continue;
                            }

                            $lineHasOtherContent = true;

                            break;
                        }//end for
                    }//end if

                    if ('phpcs:set' === substr($commentTextLower, 0, 9)) {
                        // Ignore standards for complete lines that change sniff settings.
                        if (false === $lineHasOtherTokens) {
                            $this->ignoredLines[$this->tokens[$i]['line']] = ['.all' => true];
                        }

                        // Need to maintain case here, to get the correct sniff code.
                        $parts = explode(' ', substr($commentText, 10));
                        if (\count($parts) >= 2) {
                            $sniffParts = explode('.', $parts[0]);
                            if (\count($sniffParts) >= 3) {
                                $this->tokens[$i]['sniffCode'] = array_shift($parts);
                                $this->tokens[$i]['sniffProperty'] = array_shift($parts);
                                $this->tokens[$i]['sniffPropertyValue'] = rtrim(implode(' ', $parts), " */\r\n");
                            }
                        }

                        $this->tokens[$i]['code'] = T_PHPCS_SET;
                        $this->tokens[$i]['type'] = 'T_PHPCS_SET';
                    } elseif ('phpcs:ignorefile' === substr($commentTextLower, 0, 16)) {
                        // The whole file will be ignored, but at least set the correct token.
                        $this->tokens[$i]['code'] = T_PHPCS_IGNORE_FILE;
                        $this->tokens[$i]['type'] = 'T_PHPCS_IGNORE_FILE';
                    } elseif ('phpcs:disable' === substr($commentTextLower, 0, 13)) {
                        if (false === $lineHasOtherContent) {
                            // Completely ignore the comment line.
                            $this->ignoredLines[$this->tokens[$i]['line']] = ['.all' => true];
                        }

                        if (null === $ignoring) {
                            $ignoring = [];
                        }

                        $disabledSniffs = [];

                        $additionalText = substr($commentText, 14);
                        if (true === empty($additionalText)) {
                            $ignoring = ['.all' => true];
                        } else {
                            $parts = explode(',', $additionalText);
                            foreach ($parts as $sniffCode) {
                                $sniffCode = trim($sniffCode);
                                $disabledSniffs[$sniffCode] = true;
                                $ignoring[$sniffCode] = true;

                                // This newly disabled sniff might be disabling an existing
                                // enabled exception that we are tracking.
                                if (true === isset($ignoring['.except'])) {
                                    foreach (array_keys($ignoring['.except']) as $ignoredSniffCode) {
                                        if ($ignoredSniffCode === $sniffCode
                                            || 0 === strpos($ignoredSniffCode, $sniffCode . '.')
                                        ) {
                                            unset($ignoring['.except'][$ignoredSniffCode]);
                                        }
                                    }

                                    if (true === empty($ignoring['.except'])) {
                                        unset($ignoring['.except']);
                                    }
                                }
                            }//end foreach
                        }//end if

                        $this->tokens[$i]['code'] = T_PHPCS_DISABLE;
                        $this->tokens[$i]['type'] = 'T_PHPCS_DISABLE';
                        $this->tokens[$i]['sniffCodes'] = $disabledSniffs;
                    } elseif ('phpcs:enable' === substr($commentTextLower, 0, 12)) {
                        if (null !== $ignoring) {
                            $enabledSniffs = [];

                            $additionalText = substr($commentText, 13);
                            if (true === empty($additionalText)) {
                                $ignoring = null;
                            } else {
                                $parts = explode(',', $additionalText);
                                foreach ($parts as $sniffCode) {
                                    $sniffCode = trim($sniffCode);
                                    $enabledSniffs[$sniffCode] = true;

                                    // This new enabled sniff might remove previously disabled
                                    // sniffs if it is actually a standard or category of sniffs.
                                    foreach (array_keys($ignoring) as $ignoredSniffCode) {
                                        if ($ignoredSniffCode === $sniffCode
                                            || 0 === strpos($ignoredSniffCode, $sniffCode . '.')
                                        ) {
                                            unset($ignoring[$ignoredSniffCode]);
                                        }
                                    }

                                    // This new enabled sniff might be able to clear up
                                    // previously enabled sniffs if it is actually a standard or
                                    // category of sniffs.
                                    if (true === isset($ignoring['.except'])) {
                                        foreach (array_keys($ignoring['.except']) as $ignoredSniffCode) {
                                            if ($ignoredSniffCode === $sniffCode
                                                || 0 === strpos($ignoredSniffCode, $sniffCode . '.')
                                            ) {
                                                unset($ignoring['.except'][$ignoredSniffCode]);
                                            }
                                        }
                                    }
                                }//end foreach

                                if (true === empty($ignoring)) {
                                    $ignoring = null;
                                } else {
                                    if (true === isset($ignoring['.except'])) {
                                        $ignoring['.except'] += $enabledSniffs;
                                    } else {
                                        $ignoring['.except'] = $enabledSniffs;
                                    }
                                }
                            }//end if

                            if (false === $lineHasOtherContent) {
                                // Completely ignore the comment line.
                                $this->ignoredLines[$this->tokens[$i]['line']] = ['.all' => true];
                            } else {
                                // The comment is on the same line as the code it is ignoring,
                                // so respect the new ignore rules.
                                $this->ignoredLines[$this->tokens[$i]['line']] = $ignoring;
                            }

                            $this->tokens[$i]['sniffCodes'] = $enabledSniffs;
                        }//end if

                        $this->tokens[$i]['code'] = T_PHPCS_ENABLE;
                        $this->tokens[$i]['type'] = 'T_PHPCS_ENABLE';
                    } elseif ('phpcs:ignore' === substr($commentTextLower, 0, 12)) {
                        $ignoreRules = [];

                        $additionalText = substr($commentText, 13);
                        if (true === empty($additionalText)) {
                            $ignoreRules = ['.all' => true];
                        } else {
                            $parts = explode(',', $additionalText);
                            foreach ($parts as $sniffCode) {
                                $ignoreRules[trim($sniffCode)] = true;
                            }
                        }

                        $this->tokens[$i]['code'] = T_PHPCS_IGNORE;
                        $this->tokens[$i]['type'] = 'T_PHPCS_IGNORE';
                        $this->tokens[$i]['sniffCodes'] = $ignoreRules;

                        if (null !== $ignoring) {
                            $ignoreRules += $ignoring;
                        }

                        if (false === $lineHasOtherContent) {
                            // Completely ignore the comment line, and set the following
                            // line to include the ignore rules we've set.
                            $this->ignoredLines[$this->tokens[$i]['line']] = ['.all' => true];
                            $this->ignoredLines[($this->tokens[$i]['line'] + 1)] = $ignoreRules;
                        } else {
                            // The comment is on the same line as the code it is ignoring,
                            // so respect the ignore rules it set.
                            $this->ignoredLines[$this->tokens[$i]['line']] = $ignoreRules;
                        }
                    }//end if
                }//end if
            }//end if

            if (null !== $ignoring && false === isset($this->ignoredLines[$this->tokens[$i]['line']])) {
                $this->ignoredLines[$this->tokens[$i]['line']] = $ignoring;
            }
        }//end for

        // If annotations are being ignored, we clear out all the ignore rules
        // but leave the annotations tokenized as normal.
        if (false === $checkAnnotations) {
            $this->ignoredLines = [];
        }
    }

    //end createPositionMap()

    /**
     * Creates a map of brackets positions.
     */
    private function createTokenMap()
    {
        if (PHP_CODESNIFFER_VERBOSITY > 1) {
            echo "\t*** START TOKEN MAP ***" . PHP_EOL;
        }

        $squareOpeners = [];
        $curlyOpeners = [];
        $this->numTokens = \count($this->tokens);

        $openers = [];
        $openOwner = null;

        for ($i = 0; $i < $this->numTokens; ++$i) {
            // Parenthesis mapping.

            if (true === isset(Util\Tokens::$parenthesisOpeners[$this->tokens[$i]['code']])) {
                $this->tokens[$i]['parenthesis_opener'] = null;
                $this->tokens[$i]['parenthesis_closer'] = null;
                $this->tokens[$i]['parenthesis_owner'] = $i;
                $openOwner = $i;

                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    echo str_repeat("\t", (\count($openers) + 1));
                    echo "=> Found parenthesis owner at {$i}" . PHP_EOL;
                }
            } elseif (T_OPEN_PARENTHESIS === $this->tokens[$i]['code']) {
                $openers[] = $i;
                $this->tokens[$i]['parenthesis_opener'] = $i;
                if (null !== $openOwner) {
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo str_repeat("\t", \count($openers));
                        echo "=> Found parenthesis opener at {$i} for {$openOwner}" . PHP_EOL;
                    }

                    $this->tokens[$openOwner]['parenthesis_opener'] = $i;
                    $this->tokens[$i]['parenthesis_owner'] = $openOwner;
                    $openOwner = null;
                } elseif (PHP_CODESNIFFER_VERBOSITY > 1) {
                    echo str_repeat("\t", \count($openers));
                    echo "=> Found unowned parenthesis opener at {$i}" . PHP_EOL;
                }
            } elseif (T_CLOSE_PARENTHESIS === $this->tokens[$i]['code']) {
                // Did we set an owner for this set of parenthesis?
                $numOpeners = \count($openers);
                if (0 !== $numOpeners) {
                    $opener = array_pop($openers);
                    if (true === isset($this->tokens[$opener]['parenthesis_owner'])) {
                        $owner = $this->tokens[$opener]['parenthesis_owner'];

                        $this->tokens[$owner]['parenthesis_closer'] = $i;
                        $this->tokens[$i]['parenthesis_owner'] = $owner;

                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            echo str_repeat("\t", (\count($openers) + 1));
                            echo "=> Found parenthesis closer at {$i} for {$owner}" . PHP_EOL;
                        }
                    } elseif (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo str_repeat("\t", (\count($openers) + 1));
                        echo "=> Found unowned parenthesis closer at {$i} for {$opener}" . PHP_EOL;
                    }

                    $this->tokens[$i]['parenthesis_opener'] = $opener;
                    $this->tokens[$i]['parenthesis_closer'] = $i;
                    $this->tokens[$opener]['parenthesis_closer'] = $i;
                }//end if
            }//end if

            // Bracket mapping.

            switch ($this->tokens[$i]['code']) {
            case T_OPEN_SQUARE_BRACKET:
                $squareOpeners[] = $i;

                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    echo str_repeat("\t", \count($squareOpeners));
                    echo str_repeat("\t", \count($curlyOpeners));
                    echo "=> Found square bracket opener at {$i}" . PHP_EOL;
                }

                break;
            case T_OPEN_CURLY_BRACKET:
                if (false === isset($this->tokens[$i]['scope_closer'])) {
                    $curlyOpeners[] = $i;

                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo str_repeat("\t", \count($squareOpeners));
                        echo str_repeat("\t", \count($curlyOpeners));
                        echo "=> Found curly bracket opener at {$i}" . PHP_EOL;
                    }
                }

                break;
            case T_CLOSE_SQUARE_BRACKET:
                if (false === empty($squareOpeners)) {
                    $opener = array_pop($squareOpeners);
                    $this->tokens[$i]['bracket_opener'] = $opener;
                    $this->tokens[$i]['bracket_closer'] = $i;
                    $this->tokens[$opener]['bracket_opener'] = $opener;
                    $this->tokens[$opener]['bracket_closer'] = $i;

                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo str_repeat("\t", \count($squareOpeners));
                        echo str_repeat("\t", \count($curlyOpeners));
                        echo "\t=> Found square bracket closer at {$i} for {$opener}" . PHP_EOL;
                    }
                }

                break;
            case T_CLOSE_CURLY_BRACKET:
                if (false === empty($curlyOpeners)
                    && false === isset($this->tokens[$i]['scope_opener'])
                ) {
                    $opener = array_pop($curlyOpeners);
                    $this->tokens[$i]['bracket_opener'] = $opener;
                    $this->tokens[$i]['bracket_closer'] = $i;
                    $this->tokens[$opener]['bracket_opener'] = $opener;
                    $this->tokens[$opener]['bracket_closer'] = $i;

                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo str_repeat("\t", \count($squareOpeners));
                        echo str_repeat("\t", \count($curlyOpeners));
                        echo "\t=> Found curly bracket closer at {$i} for {$opener}" . PHP_EOL;
                    }
                }

                break;
            default:
                continue 2;
            }//end switch
        }//end for

        // Cleanup for any openers that we didn't find closers for.
        // This typically means there was a syntax error breaking things.
        foreach ($openers as $opener) {
            unset($this->tokens[$opener]['parenthesis_opener'], $this->tokens[$opener]['parenthesis_owner']);
        }

        if (PHP_CODESNIFFER_VERBOSITY > 1) {
            echo "\t*** END TOKEN MAP ***" . PHP_EOL;
        }
    }

    //end createTokenMap()

    /**
     * Creates a map for the parenthesis tokens that surround other tokens.
     */
    private function createParenthesisNestingMap()
    {
        $map = [];
        for ($i = 0; $i < $this->numTokens; ++$i) {
            if (true === isset($this->tokens[$i]['parenthesis_opener'])
                && $i === $this->tokens[$i]['parenthesis_opener']
            ) {
                if (false === empty($map)) {
                    $this->tokens[$i]['nested_parenthesis'] = $map;
                }

                if (true === isset($this->tokens[$i]['parenthesis_closer'])) {
                    $map[$this->tokens[$i]['parenthesis_opener']]
                        = $this->tokens[$i]['parenthesis_closer'];
                }
            } elseif (true === isset($this->tokens[$i]['parenthesis_closer'])
                && $i === $this->tokens[$i]['parenthesis_closer']
            ) {
                array_pop($map);
                if (false === empty($map)) {
                    $this->tokens[$i]['nested_parenthesis'] = $map;
                }
            } else {
                if (false === empty($map)) {
                    $this->tokens[$i]['nested_parenthesis'] = $map;
                }
            }//end if
        }//end for
    }

    //end createParenthesisNestingMap()

    /**
     * Creates a scope map of tokens that open scopes.
     *
     * @see    recurseScopeMap()
     */
    private function createScopeMap()
    {
        if (PHP_CODESNIFFER_VERBOSITY > 1) {
            echo "\t*** START SCOPE MAP ***" . PHP_EOL;
        }

        for ($i = 0; $i < $this->numTokens; ++$i) {
            // Check to see if the current token starts a new scope.
            if (true === isset($this->scopeOpeners[$this->tokens[$i]['code']])) {
                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    $type = $this->tokens[$i]['type'];
                    $content = Util\Common::prepareForOutput($this->tokens[$i]['content']);
                    echo "\tStart scope map at {$i}:{$type} => {$content}" . PHP_EOL;
                }

                if (true === isset($this->tokens[$i]['scope_condition'])) {
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo "\t* already processed, skipping *" . PHP_EOL;
                    }

                    continue;
                }

                $i = $this->recurseScopeMap($i);
            }//end if
        }//end for

        if (PHP_CODESNIFFER_VERBOSITY > 1) {
            echo "\t*** END SCOPE MAP ***" . PHP_EOL;
        }
    }

    //end createScopeMap()

    /**
     * Recurses though the scope openers to build a scope map.
     *
     * @param int $stackPtr The position in the stack of the token that
     *                      opened the scope (eg. an IF token or FOR token).
     * @param int $depth    How many scope levels down we are.
     * @param int $ignore   How many curly braces we are ignoring.
     *
     * @return int The position in the stack that closed the scope.
     *
     * @throws \PHP_CodeSniffer\Exceptions\TokenizerException If the nesting level gets too deep.
     */
    private function recurseScopeMap($stackPtr, $depth = 1, &$ignore = 0)
    {
        if (PHP_CODESNIFFER_VERBOSITY > 1) {
            echo str_repeat("\t", $depth);
            echo "=> Begin scope map recursion at token {$stackPtr} with depth {$depth}" . PHP_EOL;
        }

        $opener = null;
        $currType = $this->tokens[$stackPtr]['code'];
        $startLine = $this->tokens[$stackPtr]['line'];

        // We will need this to restore the value if we end up
        // returning a token ID that causes our calling function to go back
        // over already ignored braces.
        $originalIgnore = $ignore;

        // If the start token for this scope opener is the same as
        // the scope token, we have already found our opener.
        if (true === isset($this->scopeOpeners[$currType]['start'][$currType])) {
            $opener = $stackPtr;
        }

        for ($i = ($stackPtr + 1); $i < $this->numTokens; ++$i) {
            $tokenType = $this->tokens[$i]['code'];

            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                $type = $this->tokens[$i]['type'];
                $line = $this->tokens[$i]['line'];
                $content = Util\Common::prepareForOutput($this->tokens[$i]['content']);

                echo str_repeat("\t", $depth);
                echo "Process token {$i} on line {$line} [";
                if (null !== $opener) {
                    echo "opener:{$opener};";
                }

                if ($ignore > 0) {
                    echo "ignore={$ignore};";
                }

                echo "]: {$type} => {$content}" . PHP_EOL;
            }//end if

            // Very special case for IF statements in PHP that can be defined without
            // scope tokens. E.g., if (1) 1; 1 ? (1 ? 1 : 1) : 1;
            // If an IF statement below this one has an opener but no
            // keyword, the opener will be incorrectly assigned to this IF statement.
            // The same case also applies to USE statements, which don't have to have
            // openers, so a following USE statement can cause an incorrect brace match.
            if ((T_IF === $currType || T_ELSE === $currType || T_USE === $currType)
                && null === $opener
                && (T_SEMICOLON === $this->tokens[$i]['code']
                || T_CLOSE_TAG === $this->tokens[$i]['code'])
            ) {
                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    $type = $this->tokens[$stackPtr]['type'];
                    echo str_repeat("\t", $depth);
                    if (T_SEMICOLON === $this->tokens[$i]['code']) {
                        $closerType = 'semicolon';
                    } else {
                        $closerType = 'close tag';
                    }

                    echo "=> Found {$closerType} before scope opener for {$stackPtr}:{$type}, bailing" . PHP_EOL;
                }

                return $i;
            }

            // Special case for PHP control structures that have no braces.
            // If we find a curly brace closer before we find the opener,
            // we're not going to find an opener. That closer probably belongs to
            // a control structure higher up.
            if (null === $opener
                && 0 === $ignore
                && T_CLOSE_CURLY_BRACKET === $tokenType
                && true === isset($this->scopeOpeners[$currType]['end'][$tokenType])
            ) {
                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    $type = $this->tokens[$stackPtr]['type'];
                    echo str_repeat("\t", $depth);
                    echo "=> Found curly brace closer before scope opener for {$stackPtr}:{$type}, bailing" . PHP_EOL;
                }

                return $i - 1;
            }

            if (null !== $opener
                && (false === isset($this->tokens[$i]['scope_opener'])
                || true === $this->scopeOpeners[$this->tokens[$stackPtr]['code']]['shared'])
                && true === isset($this->scopeOpeners[$currType]['end'][$tokenType])
            ) {
                if ($ignore > 0 && T_CLOSE_CURLY_BRACKET === $tokenType) {
                    // The last opening bracket must have been for a string
                    // offset or alike, so let's ignore it.
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo str_repeat("\t", $depth);
                        echo '* finished ignoring curly brace *' . PHP_EOL;
                    }

                    --$ignore;

                    continue;
                }
                if (T_OPEN_CURLY_BRACKET === $this->tokens[$opener]['code']
                    && T_CLOSE_CURLY_BRACKET !== $tokenType
                ) {
                    // The opener is a curly bracket so the closer must be a curly bracket as well.
                    // We ignore this closer to handle cases such as T_ELSE or T_ELSEIF being considered
                    // a closer of T_IF when it should not.
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        $type = $this->tokens[$stackPtr]['type'];
                        echo str_repeat("\t", $depth);
                        echo "=> Ignoring non-curly scope closer for {$stackPtr}:{$type}" . PHP_EOL;
                    }
                } else {
                    $scopeCloser = $i;
                    $todo = [
                        $stackPtr,
                        $opener,
                    ];

                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        $type = $this->tokens[$stackPtr]['type'];
                        $closerType = $this->tokens[$scopeCloser]['type'];
                        echo str_repeat("\t", $depth);
                        echo "=> Found scope closer ({$scopeCloser}:{$closerType}) for {$stackPtr}:{$type}" . PHP_EOL;
                    }

                    $validCloser = true;
                    if ((T_IF === $this->tokens[$stackPtr]['code'] || T_ELSEIF === $this->tokens[$stackPtr]['code'])
                        && (T_ELSE === $tokenType || T_ELSEIF === $tokenType)
                    ) {
                        // To be a closer, this token must have an opener.
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            echo str_repeat("\t", $depth);
                            echo '* closer needs to be tested *' . PHP_EOL;
                        }

                        $i = self::recurseScopeMap($i, ($depth + 1), $ignore);

                        if (false === isset($this->tokens[$scopeCloser]['scope_opener'])) {
                            $validCloser = false;
                            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                echo str_repeat("\t", $depth);
                                echo '* closer is not valid (no opener found) *' . PHP_EOL;
                            }
                        } elseif ($this->tokens[$this->tokens[$scopeCloser]['scope_opener']]['code'] !== $this->tokens[$opener]['code']) {
                            $validCloser = false;
                            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                echo str_repeat("\t", $depth);
                                $type = $this->tokens[$this->tokens[$scopeCloser]['scope_opener']]['type'];
                                $openerType = $this->tokens[$opener]['type'];
                                echo "* closer is not valid (mismatched opener type; {$type} != {$openerType}) *" . PHP_EOL;
                            }
                        } elseif (PHP_CODESNIFFER_VERBOSITY > 1) {
                            echo str_repeat("\t", $depth);
                            echo '* closer was valid *' . PHP_EOL;
                        }
                    } else {
                        // The closer was not processed, so we need to
                        // complete that token as well.
                        $todo[] = $scopeCloser;
                    }//end if

                    if (true === $validCloser) {
                        foreach ($todo as $token) {
                            $this->tokens[$token]['scope_condition'] = $stackPtr;
                            $this->tokens[$token]['scope_opener'] = $opener;
                            $this->tokens[$token]['scope_closer'] = $scopeCloser;
                        }

                        if (true === $this->scopeOpeners[$this->tokens[$stackPtr]['code']]['shared']) {
                            // As we are going back to where we started originally, restore
                            // the ignore value back to its original value.
                            $ignore = $originalIgnore;

                            return $opener;
                        }
                        if ($scopeCloser === $i
                            && true === isset($this->scopeOpeners[$tokenType])
                        ) {
                            // Unset scope_condition here or else the token will appear to have
                            // already been processed, and it will be skipped. Normally we want that,
                            // but in this case, the token is both a closer and an opener, so
                            // it needs to act like an opener. This is also why we return the
                            // token before this one; so the closer has a chance to be processed
                            // a second time, but as an opener.
                            unset($this->tokens[$scopeCloser]['scope_condition']);

                            return $i - 1;
                        }

                        return $i;
                    }

                    continue;
                    //end if
                }//end if
            }//end if

            // Is this an opening condition ?
            if (true === isset($this->scopeOpeners[$tokenType])) {
                if (null === $opener) {
                    if (T_USE === $tokenType) {
                        // PHP use keywords are special because they can be
                        // used as blocks but also inline in function definitions.
                        // So if we find them nested inside another opener, just skip them.
                        continue;
                    }

                    if (T_NAMESPACE === $tokenType) {
                        // PHP namespace keywords are special because they can be
                        // used as blocks but also inline as operators.
                        // So if we find them nested inside another opener, just skip them.
                        continue;
                    }

                    if (T_FUNCTION === $tokenType
                        && T_FUNCTION !== $this->tokens[$stackPtr]['code']
                    ) {
                        // Probably a closure, so process it manually.
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            $type = $this->tokens[$stackPtr]['type'];
                            echo str_repeat("\t", $depth);
                            echo "=> Found function before scope opener for {$stackPtr}:{$type}, processing manually" . PHP_EOL;
                        }

                        if (true === isset($this->tokens[$i]['scope_closer'])) {
                            // We've already processed this closure.
                            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                echo str_repeat("\t", $depth);
                                echo '* already processed, skipping *' . PHP_EOL;
                            }

                            $i = $this->tokens[$i]['scope_closer'];

                            continue;
                        }

                        $i = self::recurseScopeMap($i, ($depth + 1), $ignore);

                        continue;
                    }//end if

                    if (T_CLASS === $tokenType) {
                        // Probably an anonymous class inside another anonymous class,
                        // so process it manually.
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            $type = $this->tokens[$stackPtr]['type'];
                            echo str_repeat("\t", $depth);
                            echo "=> Found class before scope opener for {$stackPtr}:{$type}, processing manually" . PHP_EOL;
                        }

                        if (true === isset($this->tokens[$i]['scope_closer'])) {
                            // We've already processed this anon class.
                            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                echo str_repeat("\t", $depth);
                                echo '* already processed, skipping *' . PHP_EOL;
                            }

                            $i = $this->tokens[$i]['scope_closer'];

                            continue;
                        }

                        $i = self::recurseScopeMap($i, ($depth + 1), $ignore);

                        continue;
                    }//end if

                    // Found another opening condition but still haven't
                    // found our opener, so we are never going to find one.
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        $type = $this->tokens[$stackPtr]['type'];
                        echo str_repeat("\t", $depth);
                        echo "=> Found new opening condition before scope opener for {$stackPtr}:{$type}, ";
                    }

                    if ((T_IF === $this->tokens[$stackPtr]['code']
                        || T_ELSEIF === $this->tokens[$stackPtr]['code']
                        || T_ELSE === $this->tokens[$stackPtr]['code'])
                        && (T_ELSE === $this->tokens[$i]['code']
                        || T_ELSEIF === $this->tokens[$i]['code'])
                    ) {
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            echo 'continuing' . PHP_EOL;
                        }

                        return $i - 1;
                    }
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo 'backtracking' . PHP_EOL;
                    }

                    return $stackPtr;
                }//end if

                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    echo str_repeat("\t", $depth);
                    echo '* token is an opening condition *' . PHP_EOL;
                }

                $isShared = (true === $this->scopeOpeners[$tokenType]['shared']);

                if (true === isset($this->tokens[$i]['scope_condition'])) {
                    // We've been here before.
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo str_repeat("\t", $depth);
                        echo '* already processed, skipping *' . PHP_EOL;
                    }

                    if (false === $isShared
                        && true === isset($this->tokens[$i]['scope_closer'])
                    ) {
                        $i = $this->tokens[$i]['scope_closer'];
                    }

                    continue;
                }
                if ($currType === $tokenType
                    && false === $isShared
                    && null === $opener
                ) {
                    // We haven't yet found our opener, but we have found another
                    // scope opener which is the same type as us, and we don't
                    // share openers, so we will never find one.
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo str_repeat("\t", $depth);
                        echo '* it was another token\'s opener, bailing *' . PHP_EOL;
                    }

                    return $stackPtr;
                }
                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    echo str_repeat("\t", $depth);
                    echo '* searching for opener *' . PHP_EOL;
                }

                if (true === isset($this->scopeOpeners[$tokenType]['end'][T_CLOSE_CURLY_BRACKET])) {
                    $oldIgnore = $ignore;
                    $ignore = 0;
                }

                // PHP has a max nesting level for functions. Stop before we hit that limit
                // because too many loops means we've run into trouble anyway.
                if ($depth > 50) {
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo str_repeat("\t", $depth);
                        echo '* reached maximum nesting level; aborting *' . PHP_EOL;
                    }

                    throw new TokenizerException('Maximum nesting level reached; file could not be processed');
                }

                $oldDepth = $depth;
                if (true === $isShared
                        && true === isset($this->scopeOpeners[$tokenType]['with'][$currType])
                    ) {
                    // Don't allow the depth to increment because this is
                    // possibly not a true nesting if we are sharing our closer.
                    // This can happen, for example, when a SWITCH has a large
                    // number of CASE statements with the same shared BREAK.
                    --$depth;
                }

                $i = self::recurseScopeMap($i, ($depth + 1), $ignore);
                $depth = $oldDepth;

                if (true === isset($this->scopeOpeners[$tokenType]['end'][T_CLOSE_CURLY_BRACKET])) {
                    $ignore = $oldIgnore;
                }
                //end if
            }//end if

            if (true === isset($this->scopeOpeners[$currType]['start'][$tokenType])
                && null === $opener
            ) {
                if (T_OPEN_CURLY_BRACKET === $tokenType) {
                    if (true === isset($this->tokens[$stackPtr]['parenthesis_closer'])
                        && $i < $this->tokens[$stackPtr]['parenthesis_closer']
                    ) {
                        // We found a curly brace inside the condition of the
                        // current scope opener, so it must be a string offset.
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            echo str_repeat("\t", $depth);
                            echo '* ignoring curly brace inside condition *' . PHP_EOL;
                        }

                        ++$ignore;
                    } else {
                        // Make sure this is actually an opener and not a
                        // string offset (e.g., $var{0}).
                        for ($x = ($i - 1); $x > 0; --$x) {
                            if (true === isset(Util\Tokens::$emptyTokens[$this->tokens[$x]['code']])) {
                                continue;
                            }
                            // If the first non-whitespace/comment token looks like this
                            // brace is a string offset, or this brace is mid-way through
                            // a new statement, it isn't a scope opener.
                            $disallowed = Util\Tokens::$assignmentTokens;
                            $disallowed += [
                                T_DOLLAR => true,
                                T_VARIABLE => true,
                                T_OBJECT_OPERATOR => true,
                                T_NULLSAFE_OBJECT_OPERATOR => true,
                                T_COMMA => true,
                                T_OPEN_PARENTHESIS => true,
                            ];

                            if (true === isset($disallowed[$this->tokens[$x]['code']])) {
                                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                    echo str_repeat("\t", $depth);
                                    echo '* ignoring curly brace *' . PHP_EOL;
                                }

                                ++$ignore;
                            }

                            break;
                            //end if
                        }//end for
                    }//end if
                }//end if

                if (0 === $ignore || T_OPEN_CURLY_BRACKET !== $tokenType) {
                    $openerNested = isset($this->tokens[$i]['nested_parenthesis']);
                    $ownerNested = isset($this->tokens[$stackPtr]['nested_parenthesis']);

                    if ((true === $openerNested && false === $ownerNested)
                        || (false === $openerNested && true === $ownerNested)
                        || (true === $openerNested
                        && $this->tokens[$i]['nested_parenthesis'] !== $this->tokens[$stackPtr]['nested_parenthesis'])
                    ) {
                        // We found the a token that looks like the opener, but it's nested differently.
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            $type = $this->tokens[$i]['type'];
                            echo str_repeat("\t", $depth);
                            echo "* ignoring possible opener {$i}:{$type} as nested parenthesis don't match *" . PHP_EOL;
                        }
                    } else {
                        // We found the opening scope token for $currType.
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            $type = $this->tokens[$stackPtr]['type'];
                            echo str_repeat("\t", $depth);
                            echo "=> Found scope opener for {$stackPtr}:{$type}" . PHP_EOL;
                        }

                        $opener = $i;
                    }
                }//end if
            } elseif (T_SEMICOLON === $tokenType
                && null === $opener
                && (false === isset($this->tokens[$stackPtr]['parenthesis_closer'])
                || $i > $this->tokens[$stackPtr]['parenthesis_closer'])
            ) {
                // Found the end of a statement but still haven't
                // found our opener, so we are never going to find one.
                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    $type = $this->tokens[$stackPtr]['type'];
                    echo str_repeat("\t", $depth);
                    echo "=> Found end of statement before scope opener for {$stackPtr}:{$type}, continuing" . PHP_EOL;
                }

                return $i - 1;
            } elseif (T_OPEN_PARENTHESIS === $tokenType) {
                if (true === isset($this->tokens[$i]['parenthesis_owner'])) {
                    $owner = $this->tokens[$i]['parenthesis_owner'];
                    if (true === isset(Util\Tokens::$scopeOpeners[$this->tokens[$owner]['code']])
                        && true === isset($this->tokens[$i]['parenthesis_closer'])
                    ) {
                        // If we get into here, then we opened a parenthesis for
                        // a scope (eg. an if or else if) so we need to update the
                        // start of the line so that when we check to see
                        // if the closing parenthesis is more than n lines away from
                        // the statement, we check from the closing parenthesis.
                        $startLine = $this->tokens[$this->tokens[$i]['parenthesis_closer']]['line'];
                    }
                }
            } elseif (T_OPEN_CURLY_BRACKET === $tokenType && null !== $opener) {
                // We opened something that we don't have a scope opener for.
                // Examples of this are curly brackets for string offsets etc.
                // We want to ignore this so that we don't have an invalid scope
                // map.
                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    echo str_repeat("\t", $depth);
                    echo '* ignoring curly brace *' . PHP_EOL;
                }

                ++$ignore;
            } elseif (T_CLOSE_CURLY_BRACKET === $tokenType && $ignore > 0) {
                // We found the end token for the opener we were ignoring.
                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    echo str_repeat("\t", $depth);
                    echo '* finished ignoring curly brace *' . PHP_EOL;
                }

                --$ignore;
            } elseif (null === $opener
                && true === isset($this->scopeOpeners[$currType])
            ) {
                // If we still haven't found the opener after 30 lines,
                // we're not going to find it, unless we know it requires
                // an opener (in which case we better keep looking) or the last
                // token was empty (in which case we'll just confirm there is
                // more code in this file and not just a big comment).
                if ($this->tokens[$i]['line'] >= ($startLine + 30)
                    && false === isset(Util\Tokens::$emptyTokens[$this->tokens[($i - 1)]['code']])
                ) {
                    if (true === $this->scopeOpeners[$currType]['strict']) {
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            $type = $this->tokens[$stackPtr]['type'];
                            $lines = ($this->tokens[$i]['line'] - $startLine);
                            echo str_repeat("\t", $depth);
                            echo "=> Still looking for {$stackPtr}:{$type} scope opener after {$lines} lines" . PHP_EOL;
                        }
                    } else {
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            $type = $this->tokens[$stackPtr]['type'];
                            echo str_repeat("\t", $depth);
                            echo "=> Couldn't find scope opener for {$stackPtr}:{$type}, bailing" . PHP_EOL;
                        }

                        return $stackPtr;
                    }
                }
            } elseif (null !== $opener
                && T_BREAK !== $tokenType
                && true === isset($this->endScopeTokens[$tokenType])
            ) {
                if (false === isset($this->tokens[$i]['scope_condition'])) {
                    if ($ignore > 0) {
                        // We found the end token for the opener we were ignoring.
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            echo str_repeat("\t", $depth);
                            echo '* finished ignoring curly brace *' . PHP_EOL;
                        }

                        --$ignore;
                    } else {
                        // We found a token that closes the scope but it doesn't
                        // have a condition, so it belongs to another token and
                        // our token doesn't have a closer, so pretend this is
                        // the closer.
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            $type = $this->tokens[$stackPtr]['type'];
                            echo str_repeat("\t", $depth);
                            echo "=> Found (unexpected) scope closer for {$stackPtr}:{$type}" . PHP_EOL;
                        }

                        foreach ([$stackPtr, $opener] as $token) {
                            $this->tokens[$token]['scope_condition'] = $stackPtr;
                            $this->tokens[$token]['scope_opener'] = $opener;
                            $this->tokens[$token]['scope_closer'] = $i;
                        }

                        return $i - 1;
                    }//end if
                }//end if
            }//end if
        }//end for

        return $stackPtr;
    }

    //end recurseScopeMap()

    /**
     * Constructs the level map.
     *
     * The level map adds a 'level' index to each token which indicates the
     * depth that a token within a set of scope blocks. It also adds a
     * 'conditions' index which is an array of the scope conditions that opened
     * each of the scopes - position 0 being the first scope opener.
     */
    private function createLevelMap()
    {
        if (PHP_CODESNIFFER_VERBOSITY > 1) {
            echo "\t*** START LEVEL MAP ***" . PHP_EOL;
        }

        $this->numTokens = \count($this->tokens);
        $level = 0;
        $conditions = [];
        $lastOpener = null;
        $openers = [];

        for ($i = 0; $i < $this->numTokens; ++$i) {
            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                $type = $this->tokens[$i]['type'];
                $line = $this->tokens[$i]['line'];
                $len = $this->tokens[$i]['length'];
                $col = $this->tokens[$i]['column'];

                $content = Util\Common::prepareForOutput($this->tokens[$i]['content']);

                echo str_repeat("\t", ($level + 1));
                echo "Process token {$i} on line {$line} [col:{$col};len:{$len};lvl:{$level};";
                if (true !== empty($conditions)) {
                    $conditionString = 'conds;';
                    foreach ($conditions as $condition) {
                        $conditionString .= Util\Tokens::tokenName($condition) . ',';
                    }

                    echo rtrim($conditionString, ',') . ';';
                }

                echo "]: {$type} => {$content}" . PHP_EOL;
            }//end if

            $this->tokens[$i]['level'] = $level;
            $this->tokens[$i]['conditions'] = $conditions;

            if (true === isset($this->tokens[$i]['scope_condition'])) {
                // Check to see if this token opened the scope.
                if ($this->tokens[$i]['scope_opener'] === $i) {
                    $stackPtr = $this->tokens[$i]['scope_condition'];
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        $type = $this->tokens[$stackPtr]['type'];
                        echo str_repeat("\t", ($level + 1));
                        echo "=> Found scope opener for {$stackPtr}:{$type}" . PHP_EOL;
                    }

                    $stackPtr = $this->tokens[$i]['scope_condition'];

                    // If we find a scope opener that has a shared closer,
                    // then we need to go back over the condition map that we
                    // just created and fix ourselves as we just added some
                    // conditions where there was none. This happens for T_CASE
                    // statements that are using the same break statement.
                    if (null !== $lastOpener && $this->tokens[$lastOpener]['scope_closer'] === $this->tokens[$i]['scope_closer']) {
                        // This opener shares its closer with the previous opener,
                        // but we still need to check if the two openers share their
                        // closer with each other directly (like CASE and DEFAULT)
                        // or if they are just sharing because one doesn't have a
                        // closer (like CASE with no BREAK using a SWITCHes closer).
                        $thisType = $this->tokens[$this->tokens[$i]['scope_condition']]['code'];
                        $opener = $this->tokens[$lastOpener]['scope_condition'];

                        $isShared = isset($this->scopeOpeners[$thisType]['with'][$this->tokens[$opener]['code']]);

                        reset($this->scopeOpeners[$thisType]['end']);
                        reset($this->scopeOpeners[$this->tokens[$opener]['code']]['end']);
                        $sameEnd = (current($this->scopeOpeners[$thisType]['end']) === current($this->scopeOpeners[$this->tokens[$opener]['code']]['end']));

                        if (true === $isShared && true === $sameEnd) {
                            $badToken = $opener;
                            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                $type = $this->tokens[$badToken]['type'];
                                echo str_repeat("\t", ($level + 1));
                                echo "* shared closer, cleaning up {$badToken}:{$type} *" . PHP_EOL;
                            }

                            for ($x = $this->tokens[$i]['scope_condition']; $x <= $i; ++$x) {
                                $oldConditions = $this->tokens[$x]['conditions'];
                                $oldLevel = $this->tokens[$x]['level'];
                                --$this->tokens[$x]['level'];
                                unset($this->tokens[$x]['conditions'][$badToken]);
                                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                    $type = $this->tokens[$x]['type'];
                                    $oldConds = '';
                                    foreach ($oldConditions as $condition) {
                                        $oldConds .= Util\Tokens::tokenName($condition) . ',';
                                    }

                                    $oldConds = rtrim($oldConds, ',');

                                    $newConds = '';
                                    foreach ($this->tokens[$x]['conditions'] as $condition) {
                                        $newConds .= Util\Tokens::tokenName($condition) . ',';
                                    }

                                    $newConds = rtrim($newConds, ',');

                                    $newLevel = $this->tokens[$x]['level'];
                                    echo str_repeat("\t", ($level + 1));
                                    echo "* cleaned {$x}:{$type} *" . PHP_EOL;
                                    echo str_repeat("\t", ($level + 2));
                                    echo "=> level changed from {$oldLevel} to {$newLevel}" . PHP_EOL;
                                    echo str_repeat("\t", ($level + 2));
                                    echo "=> conditions changed from {$oldConds} to {$newConds}" . PHP_EOL;
                                }//end if
                            }//end for

                            unset($conditions[$badToken]);
                            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                $type = $this->tokens[$badToken]['type'];
                                echo str_repeat("\t", ($level + 1));
                                echo "* token {$badToken}:{$type} removed from conditions array *" . PHP_EOL;
                            }

                            unset($openers[$lastOpener]);

                            --$level;
                            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                echo str_repeat("\t", ($level + 2));
                                echo '* level decreased *' . PHP_EOL;
                            }
                        }//end if
                    }//end if

                    ++$level;
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo str_repeat("\t", ($level + 1));
                        echo '* level increased *' . PHP_EOL;
                    }

                    $conditions[$stackPtr] = $this->tokens[$stackPtr]['code'];
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        $type = $this->tokens[$stackPtr]['type'];
                        echo str_repeat("\t", ($level + 1));
                        echo "* token {$stackPtr}:{$type} added to conditions array *" . PHP_EOL;
                    }

                    $lastOpener = $this->tokens[$i]['scope_opener'];
                    if (null !== $lastOpener) {
                        $openers[$lastOpener] = $lastOpener;
                    }
                } elseif (null !== $lastOpener && $this->tokens[$lastOpener]['scope_closer'] === $i) {
                    foreach (array_reverse($openers) as $opener) {
                        if ($this->tokens[$opener]['scope_closer'] === $i) {
                            $oldOpener = array_pop($openers);
                            if (false === empty($openers)) {
                                $lastOpener = array_pop($openers);
                                $openers[$lastOpener] = $lastOpener;
                            } else {
                                $lastOpener = null;
                            }

                            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                $type = $this->tokens[$oldOpener]['type'];
                                echo str_repeat("\t", ($level + 1));
                                echo "=> Found scope closer for {$oldOpener}:{$type}" . PHP_EOL;
                            }

                            $oldCondition = array_pop($conditions);
                            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                echo str_repeat("\t", ($level + 1));
                                echo '* token ' . Util\Tokens::tokenName($oldCondition) . ' removed from conditions array *' . PHP_EOL;
                            }

                            // Make sure this closer actually belongs to us.
                            // Either the condition also has to think this is the
                            // closer, or it has to allow sharing with us.
                            $condition = $this->tokens[$this->tokens[$i]['scope_condition']]['code'];
                            if ($condition !== $oldCondition) {
                                if (false === isset($this->scopeOpeners[$oldCondition]['with'][$condition])) {
                                    $badToken = $this->tokens[$oldOpener]['scope_condition'];

                                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                        $type = Util\Tokens::tokenName($oldCondition);
                                        echo str_repeat("\t", ($level + 1));
                                        echo "* scope closer was bad, cleaning up {$badToken}:{$type} *" . PHP_EOL;
                                    }

                                    for ($x = ($oldOpener + 1); $x <= $i; ++$x) {
                                        $oldConditions = $this->tokens[$x]['conditions'];
                                        $oldLevel = $this->tokens[$x]['level'];
                                        --$this->tokens[$x]['level'];
                                        unset($this->tokens[$x]['conditions'][$badToken]);
                                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                            $type = $this->tokens[$x]['type'];
                                            $oldConds = '';
                                            foreach ($oldConditions as $condition) {
                                                $oldConds .= Util\Tokens::tokenName($condition) . ',';
                                            }

                                            $oldConds = rtrim($oldConds, ',');

                                            $newConds = '';
                                            foreach ($this->tokens[$x]['conditions'] as $condition) {
                                                $newConds .= Util\Tokens::tokenName($condition) . ',';
                                            }

                                            $newConds = rtrim($newConds, ',');

                                            $newLevel = $this->tokens[$x]['level'];
                                            echo str_repeat("\t", ($level + 1));
                                            echo "* cleaned {$x}:{$type} *" . PHP_EOL;
                                            echo str_repeat("\t", ($level + 2));
                                            echo "=> level changed from {$oldLevel} to {$newLevel}" . PHP_EOL;
                                            echo str_repeat("\t", ($level + 2));
                                            echo "=> conditions changed from {$oldConds} to {$newConds}" . PHP_EOL;
                                        }//end if
                                    }//end for
                                }//end if
                            }//end if

                            --$level;
                            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                                echo str_repeat("\t", ($level + 2));
                                echo '* level decreased *' . PHP_EOL;
                            }

                            $this->tokens[$i]['level'] = $level;
                            $this->tokens[$i]['conditions'] = $conditions;
                        }//end if
                    }//end foreach
                }//end if
            }//end if
        }//end for

        if (PHP_CODESNIFFER_VERBOSITY > 1) {
            echo "\t*** END LEVEL MAP ***" . PHP_EOL;
        }
    }

    //end createLevelMap()
}//end class
