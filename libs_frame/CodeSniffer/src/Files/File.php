<?php
/**
 * Represents a piece of content being checked during the run.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Files;

use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Exceptions\RuntimeException;
use PHP_CodeSniffer\Exceptions\TokenizerException;
use PHP_CodeSniffer\Fixer;
use PHP_CodeSniffer\Ruleset;
use PHP_CodeSniffer\Util;

class File
{
    /**
     * The absolute path to the file associated with this object.
     *
     * @var string
     */
    public $path = '';

    /**
     * The config data for the run.
     *
     * @var \PHP_CodeSniffer\Config
     */
    public $config;

    /**
     * The ruleset used for the run.
     *
     * @var \PHP_CodeSniffer\Ruleset
     */
    public $ruleset;

    /**
     * If TRUE, the entire file is being ignored.
     *
     * @var bool
     */
    public $ignored = false;

    /**
     * The EOL character this file uses.
     *
     * @var string
     */
    public $eolChar = '';

    /**
     * The Fixer object to control fixing errors.
     *
     * @var \PHP_CodeSniffer\Fixer
     */
    public $fixer;

    /**
     * The tokenizer being used for this file.
     *
     * @var \PHP_CodeSniffer\Tokenizers\Tokenizer
     */
    public $tokenizer;

    /**
     * The name of the tokenizer being used for this file.
     *
     * @var string
     */
    public $tokenizerType = 'PHP';

    /**
     * Was the file loaded from cache?
     *
     * If TRUE, the file was loaded from a local cache.
     * If FALSE, the file was tokenized and processed fully.
     *
     * @var bool
     */
    public $fromCache = false;

    /**
     * The number of tokens in this file.
     *
     * Stored here to save calling count() everywhere.
     *
     * @var int
     */
    public $numTokens = 0;

    /**
     * The content of the file.
     *
     * @var string
     */
    protected $content = '';

    /**
     * The tokens stack map.
     *
     * @var array
     */
    protected $tokens = [];

    /**
     * The errors raised from sniffs.
     *
     * @var array
     *
     * @see getErrors()
     */
    protected $errors = [];

    /**
     * The warnings raised from sniffs.
     *
     * @var array
     *
     * @see getWarnings()
     */
    protected $warnings = [];

    /**
     * The metrics recorded by sniffs.
     *
     * @var array
     *
     * @see getMetrics()
     */
    protected $metrics = [];

    /**
     * The total number of errors raised.
     *
     * @var int
     */
    protected $errorCount = 0;

    /**
     * The total number of warnings raised.
     *
     * @var int
     */
    protected $warningCount = 0;

    /**
     * The total number of errors and warnings that can be fixed.
     *
     * @var int
     */
    protected $fixableCount = 0;

    /**
     * The total number of errors and warnings that were fixed.
     *
     * @var int
     */
    protected $fixedCount = 0;

    /**
     * TRUE if errors are being replayed from the cache.
     *
     * @var bool
     */
    protected $replayingErrors = false;

    /**
     * An array of sniffs that are being ignored.
     *
     * @var array
     */
    protected $ignoredListeners = [];

    /**
     * An array of message codes that are being ignored.
     *
     * @var array
     */
    protected $ignoredCodes = [];

    /**
     * An array of sniffs listening to this file's processing.
     *
     * @var \PHP_CodeSniffer\Sniffs\Sniff[]
     */
    protected $listeners = [];

    /**
     * The class name of the sniff currently processing the file.
     *
     * @var string
     */
    protected $activeListener = '';

    /**
     * An array of sniffs being processed and how long they took.
     *
     * @var array
     */
    protected $listenerTimes = [];

    /**
     * A cache of often used config settings to improve performance.
     *
     * Storing them here saves 10k+ calls to __get() in the Config class.
     *
     * @var array
     */
    protected $configCache = [];

    /**
     * The metrics recorded for each token.
     *
     * Stops the same metric being recorded for the same token twice.
     *
     * @var array
     *
     * @see getMetrics()
     */
    private $metricTokens = [];

    /**
     * Constructs a file.
     *
     * @param string                   $path    The absolute path to the file to process.
     * @param \PHP_CodeSniffer\Ruleset $ruleset The ruleset used for the run.
     * @param \PHP_CodeSniffer\Config  $config  The config data for the run.
     */
    public function __construct($path, Ruleset $ruleset, Config $config)
    {
        $this->path = $path;
        $this->ruleset = $ruleset;
        $this->config = $config;
        $this->fixer = new Fixer();

        $parts = explode('.', $path);
        $extension = array_pop($parts);
        if (true === isset($config->extensions[$extension])) {
            $this->tokenizerType = $config->extensions[$extension];
        } else {
            // Revert to default.
            $this->tokenizerType = 'PHP';
        }

        $this->configCache['cache'] = $this->config->cache;
        $this->configCache['sniffs'] = array_map('strtolower', $this->config->sniffs);
        $this->configCache['exclude'] = array_map('strtolower', $this->config->exclude);
        $this->configCache['errorSeverity'] = $this->config->errorSeverity;
        $this->configCache['warningSeverity'] = $this->config->warningSeverity;
        $this->configCache['recordErrors'] = $this->config->recordErrors;
        $this->configCache['ignorePatterns'] = $this->ruleset->ignorePatterns;
        $this->configCache['includePatterns'] = $this->ruleset->includePatterns;
    }

    //end __construct()

    /**
     * Set the content of the file.
     *
     * Setting the content also calculates the EOL char being used.
     *
     * @param string $content The file content.
     */
    public function setContent($content)
    {
        $this->content = $content;
        $this->tokens = [];

        try {
            $this->eolChar = Util\Common::detectLineEndings($content);
        } catch (RuntimeException $e) {
            $this->addWarningOnLine($e->getMessage(), 1, 'Internal.DetectLineEndings');

            return;
        }
    }

    //end setContent()

    /**
     * Reloads the content of the file.
     *
     * By default, we have no idea where our content comes from,
     * so we can't do anything.
     */
    public function reloadContent()
    {
    }

    //end reloadContent()

    /**
     * Disables caching of this file.
     */
    public function disableCaching()
    {
        $this->configCache['cache'] = false;
    }

    //end disableCaching()

    /**
     * Starts the stack traversal and tells listeners when tokens are found.
     */
    public function process()
    {
        if (true === $this->ignored) {
            return;
        }

        $this->errors = [];
        $this->warnings = [];
        $this->errorCount = 0;
        $this->warningCount = 0;
        $this->fixableCount = 0;

        $this->parse();

        // Check if tokenizer errors cause this file to be ignored.
        if (true === $this->ignored) {
            return;
        }

        $this->fixer->startFile($this);

        if (PHP_CODESNIFFER_VERBOSITY > 2) {
            echo "\t*** START TOKEN PROCESSING ***" . PHP_EOL;
        }

        $foundCode = false;
        $listenerIgnoreTo = [];
        $inTests = \defined('PHP_CODESNIFFER_IN_TESTS');
        $checkAnnotations = $this->config->annotations;

        // Foreach of the listeners that have registered to listen for this
        // token, get them to process it.
        foreach ($this->tokens as $stackPtr => $token) {
            // Check for ignored lines.
            if (true === $checkAnnotations
                && (T_COMMENT === $token['code']
                || T_PHPCS_IGNORE_FILE === $token['code']
                || T_PHPCS_SET === $token['code']
                || T_DOC_COMMENT_STRING === $token['code']
                || T_DOC_COMMENT_TAG === $token['code']
                || (true === $inTests && T_INLINE_HTML === $token['code']))
            ) {
                $commentText = ltrim($this->tokens[$stackPtr]['content'], ' /*');
                $commentTextLower = strtolower($commentText);
                if (false !== strpos($commentText, '@codingStandards')) {
                    if (false !== strpos($commentText, '@codingStandardsIgnoreFile')) {
                        // Ignoring the whole file, just a little late.
                        $this->errors = [];
                        $this->warnings = [];
                        $this->errorCount = 0;
                        $this->warningCount = 0;
                        $this->fixableCount = 0;

                        return;
                    }
                    if (false !== strpos($commentText, '@codingStandardsChangeSetting')) {
                        $start = strpos($commentText, '@codingStandardsChangeSetting');
                        $comment = substr($commentText, ($start + 30));
                        $parts = explode(' ', $comment);
                        if (\count($parts) >= 2) {
                            $sniffParts = explode('.', $parts[0]);
                            if (\count($sniffParts) >= 3) {
                                // If the sniff code is not known to us, it has not been registered in this run.
                                // But don't throw an error as it could be there for a different standard to use.
                                if (true === isset($this->ruleset->sniffCodes[$parts[0]])) {
                                    $listenerCode = array_shift($parts);
                                    $propertyCode = array_shift($parts);
                                    $propertyValue = rtrim(implode(' ', $parts), " */\r\n");
                                    $listenerClass = $this->ruleset->sniffCodes[$listenerCode];
                                    $this->ruleset->setSniffProperty($listenerClass, $propertyCode, $propertyValue);
                                }
                            }
                        }
                    }//end if
                } elseif ('phpcs:ignorefile' === substr($commentTextLower, 0, 16)
                    || '@phpcs:ignorefile' === substr($commentTextLower, 0, 17)
                ) {
                    // Ignoring the whole file, just a little late.
                    $this->errors = [];
                    $this->warnings = [];
                    $this->errorCount = 0;
                    $this->warningCount = 0;
                    $this->fixableCount = 0;

                    return;
                } elseif ('phpcs:set' === substr($commentTextLower, 0, 9)
                    || '@phpcs:set' === substr($commentTextLower, 0, 10)
                ) {
                    if (true === isset($token['sniffCode'])) {
                        $listenerCode = $token['sniffCode'];
                        if (true === isset($this->ruleset->sniffCodes[$listenerCode])) {
                            $propertyCode = $token['sniffProperty'];
                            $propertyValue = $token['sniffPropertyValue'];
                            $listenerClass = $this->ruleset->sniffCodes[$listenerCode];
                            $this->ruleset->setSniffProperty($listenerClass, $propertyCode, $propertyValue);
                        }
                    }
                }//end if
            }//end if

            if (PHP_CODESNIFFER_VERBOSITY > 2) {
                $type = $token['type'];
                $content = Util\Common::prepareForOutput($token['content']);
                echo "\t\tProcess token {$stackPtr}: {$type} => {$content}" . PHP_EOL;
            }

            if (T_INLINE_HTML !== $token['code']) {
                $foundCode = true;
            }

            if (false === isset($this->ruleset->tokenListeners[$token['code']])) {
                continue;
            }

            foreach ($this->ruleset->tokenListeners[$token['code']] as $listenerData) {
                if (true === isset($this->ignoredListeners[$listenerData['class']])
                    || (true === isset($listenerIgnoreTo[$listenerData['class']])
                    && $listenerIgnoreTo[$listenerData['class']] > $stackPtr)
                ) {
                    // This sniff is ignoring past this token, or the whole file.
                    continue;
                }

                // Make sure this sniff supports the tokenizer
                // we are currently using.
                $class = $listenerData['class'];

                if (false === isset($listenerData['tokenizers'][$this->tokenizerType])) {
                    continue;
                }

                if ('STDIN' !== trim($this->path, '\'"')) {
                    // If the file path matches one of our ignore patterns, skip it.
                    // While there is support for a type of each pattern
                    // (absolute or relative) we don't actually support it here.
                    foreach ($listenerData['ignore'] as $pattern) {
                        // We assume a / directory separator, as do the exclude rules
                        // most developers write, so we need a special case for any system
                        // that is different.
                        if (\DIRECTORY_SEPARATOR === '\\') {
                            $pattern = str_replace('/', '\\\\', $pattern);
                        }

                        $pattern = '`' . $pattern . '`i';
                        if (1 === preg_match($pattern, $this->path)) {
                            $this->ignoredListeners[$class] = true;

                            continue 2;
                        }
                    }

                    // If the file path does not match one of our include patterns, skip it.
                    // While there is support for a type of each pattern
                    // (absolute or relative) we don't actually support it here.
                    if (false === empty($listenerData['include'])) {
                        $included = false;
                        foreach ($listenerData['include'] as $pattern) {
                            // We assume a / directory separator, as do the exclude rules
                            // most developers write, so we need a special case for any system
                            // that is different.
                            if (\DIRECTORY_SEPARATOR === '\\') {
                                $pattern = str_replace('/', '\\\\', $pattern);
                            }

                            $pattern = '`' . $pattern . '`i';
                            if (1 === preg_match($pattern, $this->path)) {
                                $included = true;

                                break;
                            }
                        }

                        if (false === $included) {
                            $this->ignoredListeners[$class] = true;

                            continue;
                        }
                    }//end if
                }//end if

                $this->activeListener = $class;

                if (PHP_CODESNIFFER_VERBOSITY > 2) {
                    $startTime = microtime(true);
                    echo "\t\t\tProcessing " . $this->activeListener . '... ';
                }

                $ignoreTo = $this->ruleset->sniffs[$class]->process($this, $stackPtr);
                if (null !== $ignoreTo) {
                    $listenerIgnoreTo[$this->activeListener] = $ignoreTo;
                }

                if (PHP_CODESNIFFER_VERBOSITY > 2) {
                    $timeTaken = (microtime(true) - $startTime);
                    if (false === isset($this->listenerTimes[$this->activeListener])) {
                        $this->listenerTimes[$this->activeListener] = 0;
                    }

                    $this->listenerTimes[$this->activeListener] += $timeTaken;

                    $timeTaken = round(($timeTaken), 4);
                    echo "DONE in {$timeTaken} seconds" . PHP_EOL;
                }

                $this->activeListener = '';
            }//end foreach
        }//end foreach

        // If short open tags are off but the file being checked uses
        // short open tags, the whole content will be inline HTML
        // and nothing will be checked. So try and handle this case.
        // We don't show this error for STDIN because we can't be sure the content
        // actually came directly from the user. It could be something like
        // refs from a Git pre-push hook.
        if (false === $foundCode && 'PHP' === $this->tokenizerType && 'STDIN' !== $this->path) {
            $shortTags = (bool)ini_get('short_open_tag');
            if (false === $shortTags) {
                $error = 'No PHP code was found in this file and short open tags are not allowed by this install of PHP. This file may be using short open tags but PHP does not allow them.';
                $this->addWarning($error, null, 'Internal.NoCodeFound');
            }
        }

        if (PHP_CODESNIFFER_VERBOSITY > 2) {
            echo "\t*** END TOKEN PROCESSING ***" . PHP_EOL;
            echo "\t*** START SNIFF PROCESSING REPORT ***" . PHP_EOL;

            asort($this->listenerTimes, SORT_NUMERIC);
            $this->listenerTimes = array_reverse($this->listenerTimes, true);
            foreach ($this->listenerTimes as $listener => $timeTaken) {
                echo "\t{$listener}: " . round(($timeTaken), 4) . ' secs' . PHP_EOL;
            }

            echo "\t*** END SNIFF PROCESSING REPORT ***" . PHP_EOL;
        }

        $this->fixedCount += $this->fixer->getFixCount();
    }

    //end process()

    /**
     * Tokenizes the file and prepares it for the test run.
     */
    public function parse()
    {
        if (false === empty($this->tokens)) {
            // File has already been parsed.
            return;
        }

        try {
            $tokenizerClass = 'PHP_CodeSniffer\Tokenizers\\' . $this->tokenizerType;
            $this->tokenizer = new $tokenizerClass($this->content, $this->config, $this->eolChar);
            $this->tokens = $this->tokenizer->getTokens();
        } catch (TokenizerException $e) {
            $this->ignored = true;
            $this->addWarning($e->getMessage(), null, 'Internal.Tokenizer.Exception');
            if (PHP_CODESNIFFER_VERBOSITY > 0) {
                echo "[{$this->tokenizerType} => tokenizer error]... ";
                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    echo PHP_EOL;
                }
            }

            return;
        }

        $this->numTokens = \count($this->tokens);

        // Check for mixed line endings as these can cause tokenizer errors and we
        // should let the user know that the results they get may be incorrect.
        // This is done by removing all backslashes, removing the newline char we
        // detected, then converting newlines chars into text. If any backslashes
        // are left at the end, we have additional newline chars in use.
        $contents = str_replace('\\', '', $this->content);
        $contents = str_replace($this->eolChar, '', $contents);
        $contents = str_replace("\n", '\n', $contents);
        $contents = str_replace("\r", '\r', $contents);
        if (false !== strpos($contents, '\\')) {
            $error = 'File has mixed line endings; this may cause incorrect results';
            $this->addWarningOnLine($error, 1, 'Internal.LineEndings.Mixed');
        }

        if (PHP_CODESNIFFER_VERBOSITY > 0) {
            if (0 === $this->numTokens) {
                $numLines = 0;
            } else {
                $numLines = $this->tokens[($this->numTokens - 1)]['line'];
            }

            echo "[{$this->tokenizerType} => {$this->numTokens} tokens in {$numLines} lines]... ";
            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                echo PHP_EOL;
            }
        }
    }

    //end parse()

    /**
     * Returns the token stack for this file.
     *
     * @return array
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    //end getTokens()

    /**
     * Remove vars stored in this file that are no longer required.
     */
    public function cleanUp()
    {
        $this->listenerTimes = null;
        $this->content = null;
        $this->tokens = null;
        $this->metricTokens = null;
        $this->tokenizer = null;
        $this->fixer = null;
        $this->config = null;
        $this->ruleset = null;
    }

    //end cleanUp()

    /**
     * Records an error against a specific token in the file.
     *
     * @param string $error    The error message.
     * @param int    $stackPtr The stack position where the error occurred.
     * @param string $code     A violation code unique to the sniff message.
     * @param array  $data     Replacements for the error message.
     * @param int    $severity The severity level for this error. A value of 0
     *                         will be converted into the default severity level.
     * @param bool   $fixable  Can the error be fixed by the sniff?
     *
     * @return bool
     */
    public function addError(
        $error,
        $stackPtr,
        $code,
        $data = [],
        $severity = 0,
        $fixable = false
    ) {
        if (null === $stackPtr) {
            $line = 1;
            $column = 1;
        } else {
            $line = $this->tokens[$stackPtr]['line'];
            $column = $this->tokens[$stackPtr]['column'];
        }

        return $this->addMessage(true, $error, $line, $column, $code, $data, $severity, $fixable);
    }

    //end addError()

    /**
     * Records a warning against a specific token in the file.
     *
     * @param string $warning  The error message.
     * @param int    $stackPtr The stack position where the error occurred.
     * @param string $code     A violation code unique to the sniff message.
     * @param array  $data     Replacements for the warning message.
     * @param int    $severity The severity level for this warning. A value of 0
     *                         will be converted into the default severity level.
     * @param bool   $fixable  Can the warning be fixed by the sniff?
     *
     * @return bool
     */
    public function addWarning(
        $warning,
        $stackPtr,
        $code,
        $data = [],
        $severity = 0,
        $fixable = false
    ) {
        if (null === $stackPtr) {
            $line = 1;
            $column = 1;
        } else {
            $line = $this->tokens[$stackPtr]['line'];
            $column = $this->tokens[$stackPtr]['column'];
        }

        return $this->addMessage(false, $warning, $line, $column, $code, $data, $severity, $fixable);
    }

    //end addWarning()

    /**
     * Records an error against a specific line in the file.
     *
     * @param string $error    The error message.
     * @param int    $line     The line on which the error occurred.
     * @param string $code     A violation code unique to the sniff message.
     * @param array  $data     Replacements for the error message.
     * @param int    $severity The severity level for this error. A value of 0
     *                         will be converted into the default severity level.
     *
     * @return bool
     */
    public function addErrorOnLine(
        $error,
        $line,
        $code,
        $data = [],
        $severity = 0
    ) {
        return $this->addMessage(true, $error, $line, 1, $code, $data, $severity, false);
    }

    //end addErrorOnLine()

    /**
     * Records a warning against a specific token in the file.
     *
     * @param string $warning  The error message.
     * @param int    $line     The line on which the warning occurred.
     * @param string $code     A violation code unique to the sniff message.
     * @param array  $data     Replacements for the warning message.
     * @param int    $severity The severity level for this warning. A value of 0 will
     *                         will be converted into the default severity level.
     *
     * @return bool
     */
    public function addWarningOnLine(
        $warning,
        $line,
        $code,
        $data = [],
        $severity = 0
    ) {
        return $this->addMessage(false, $warning, $line, 1, $code, $data, $severity, false);
    }

    //end addWarningOnLine()

    /**
     * Records a fixable error against a specific token in the file.
     *
     * Returns true if the error was recorded and should be fixed.
     *
     * @param string $error    The error message.
     * @param int    $stackPtr The stack position where the error occurred.
     * @param string $code     A violation code unique to the sniff message.
     * @param array  $data     Replacements for the error message.
     * @param int    $severity The severity level for this error. A value of 0
     *                         will be converted into the default severity level.
     *
     * @return bool
     */
    public function addFixableError(
        $error,
        $stackPtr,
        $code,
        $data = [],
        $severity = 0
    ) {
        $recorded = $this->addError($error, $stackPtr, $code, $data, $severity, true);
        if (true === $recorded && true === $this->fixer->enabled) {
            return true;
        }

        return false;
    }

    //end addFixableError()

    /**
     * Records a fixable warning against a specific token in the file.
     *
     * Returns true if the warning was recorded and should be fixed.
     *
     * @param string $warning  The error message.
     * @param int    $stackPtr The stack position where the error occurred.
     * @param string $code     A violation code unique to the sniff message.
     * @param array  $data     Replacements for the warning message.
     * @param int    $severity The severity level for this warning. A value of 0
     *                         will be converted into the default severity level.
     *
     * @return bool
     */
    public function addFixableWarning(
        $warning,
        $stackPtr,
        $code,
        $data = [],
        $severity = 0
    ) {
        $recorded = $this->addWarning($warning, $stackPtr, $code, $data, $severity, true);
        if (true === $recorded && true === $this->fixer->enabled) {
            return true;
        }

        return false;
    }

    //end addFixableWarning()

    /**
     * Record a metric about the file being examined.
     *
     * @param int    $stackPtr The stack position where the metric was recorded.
     * @param string $metric   The name of the metric being recorded.
     * @param string $value    The value of the metric being recorded.
     *
     * @return bool
     */
    public function recordMetric($stackPtr, $metric, $value)
    {
        if (false === isset($this->metrics[$metric])) {
            $this->metrics[$metric] = ['values' => [$value => 1]];
            $this->metricTokens[$metric][$stackPtr] = true;
        } elseif (false === isset($this->metricTokens[$metric][$stackPtr])) {
            $this->metricTokens[$metric][$stackPtr] = true;
            if (false === isset($this->metrics[$metric]['values'][$value])) {
                $this->metrics[$metric]['values'][$value] = 1;
            } else {
                ++$this->metrics[$metric]['values'][$value];
            }
        }

        return true;
    }

    //end recordMetric()

    /**
     * Returns the number of errors raised.
     *
     * @return int
     */
    public function getErrorCount()
    {
        return $this->errorCount;
    }

    //end getErrorCount()

    /**
     * Returns the number of warnings raised.
     *
     * @return int
     */
    public function getWarningCount()
    {
        return $this->warningCount;
    }

    //end getWarningCount()

    /**
     * Returns the number of fixable errors/warnings raised.
     *
     * @return int
     */
    public function getFixableCount()
    {
        return $this->fixableCount;
    }

    //end getFixableCount()

    /**
     * Returns the number of fixed errors/warnings.
     *
     * @return int
     */
    public function getFixedCount()
    {
        return $this->fixedCount;
    }

    //end getFixedCount()

    /**
     * Returns the list of ignored lines.
     *
     * @return array
     */
    public function getIgnoredLines()
    {
        return $this->tokenizer->ignoredLines;
    }

    //end getIgnoredLines()

    /**
     * Returns the errors raised from processing this file.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    //end getErrors()

    /**
     * Returns the warnings raised from processing this file.
     *
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    //end getWarnings()

    /**
     * Returns the metrics found while processing this file.
     *
     * @return array
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

    //end getMetrics()

    /**
     * Returns the absolute filename of this file.
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->path;
    }

    //end getFilename()

    /**
     * Returns the declaration names for classes, interfaces, traits, and functions.
     *
     * @param int $stackPtr The position of the declaration token which
     *                      declared the class, interface, trait, or function.
     *
     * @return null|string The name of the class, interface, trait, or function;
     *                     or NULL if the function or class is anonymous.
     *
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException If the specified token is not of type
     *                                                      T_FUNCTION, T_CLASS, T_ANON_CLASS,
     *                                                      T_CLOSURE, T_TRAIT, or T_INTERFACE.
     */
    public function getDeclarationName($stackPtr)
    {
        $tokenCode = $this->tokens[$stackPtr]['code'];

        if (T_ANON_CLASS === $tokenCode || T_CLOSURE === $tokenCode) {
            return;
        }

        if (T_FUNCTION !== $tokenCode
            && T_CLASS !== $tokenCode
            && T_INTERFACE !== $tokenCode
            && T_TRAIT !== $tokenCode
        ) {
            throw new RuntimeException('Token type "' . $this->tokens[$stackPtr]['type'] . '" is not T_FUNCTION, T_CLASS, T_INTERFACE or T_TRAIT');
        }

        if (T_FUNCTION === $tokenCode
            && 'function' !== strtolower($this->tokens[$stackPtr]['content'])
        ) {
            // This is a function declared without the "function" keyword.
            // So this token is the function name.
            return $this->tokens[$stackPtr]['content'];
        }

        $content = null;
        for ($i = $stackPtr; $i < $this->numTokens; ++$i) {
            if (T_STRING === $this->tokens[$i]['code']) {
                $content = $this->tokens[$i]['content'];

                break;
            }
        }

        return $content;
    }

    //end getDeclarationName()

    /**
     * Returns the method parameters for the specified function token.
     *
     * Also supports passing in a USE token for a closure use group.
     *
     * Each parameter is in the following format:
     *
     * <code>
     *   0 => array(
     *         'name'                => '$var',  // The variable name.
     *         'token'               => integer, // The stack pointer to the variable name.
     *         'content'             => string,  // The full content of the variable definition.
     *         'pass_by_reference'   => boolean, // Is the variable passed by reference?
     *         'reference_token'     => integer, // The stack pointer to the reference operator
     *                                           // or FALSE if the param is not passed by reference.
     *         'variable_length'     => boolean, // Is the param of variable length through use of `...` ?
     *         'variadic_token'      => integer, // The stack pointer to the ... operator
     *                                           // or FALSE if the param is not variable length.
     *         'type_hint'           => string,  // The type hint for the variable.
     *         'type_hint_token'     => integer, // The stack pointer to the start of the type hint
     *                                           // or FALSE if there is no type hint.
     *         'type_hint_end_token' => integer, // The stack pointer to the end of the type hint
     *                                           // or FALSE if there is no type hint.
     *         'nullable_type'       => boolean, // TRUE if the type is preceded by the nullability
     *                                           // operator.
     *         'comma_token'         => integer, // The stack pointer to the comma after the param
     *                                           // or FALSE if this is the last param.
     *        )
     * </code>
     *
     * Parameters with default values have additional array indexes of:
     *         'default'             => string,  // The full content of the default value.
     *         'default_token'       => integer, // The stack pointer to the start of the default value.
     *         'default_equal_token' => integer, // The stack pointer to the equals sign.
     *
     * Parameters declared using PHP 8 constructor property promotion, have these additional array indexes:
     *         'property_visibility' => string,  // The property visibility as declared.
     *         'visibility_token'    => integer, // The stack pointer to the visibility modifier token.
     *
     * @param int $stackPtr The position in the stack of the function token
     *                      to acquire the parameters for.
     *
     * @return array
     *
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException If the specified $stackPtr is not of
     *                                                      type T_FUNCTION, T_CLOSURE, T_USE,
     *                                                      or T_FN.
     */
    public function getMethodParameters($stackPtr)
    {
        if (T_FUNCTION !== $this->tokens[$stackPtr]['code']
            && T_CLOSURE !== $this->tokens[$stackPtr]['code']
            && T_USE !== $this->tokens[$stackPtr]['code']
            && T_FN !== $this->tokens[$stackPtr]['code']
        ) {
            throw new RuntimeException('$stackPtr must be of type T_FUNCTION or T_CLOSURE or T_USE or T_FN');
        }

        if (T_USE === $this->tokens[$stackPtr]['code']) {
            $opener = $this->findNext(T_OPEN_PARENTHESIS, ($stackPtr + 1));
            if (false === $opener || true === isset($this->tokens[$opener]['parenthesis_owner'])) {
                throw new RuntimeException('$stackPtr was not a valid T_USE');
            }
        } else {
            if (false === isset($this->tokens[$stackPtr]['parenthesis_opener'])) {
                // Live coding or syntax error, so no params to find.
                return [];
            }

            $opener = $this->tokens[$stackPtr]['parenthesis_opener'];
        }

        if (false === isset($this->tokens[$opener]['parenthesis_closer'])) {
            // Live coding or syntax error, so no params to find.
            return [];
        }

        $closer = $this->tokens[$opener]['parenthesis_closer'];

        $vars = [];
        $currVar = null;
        $paramStart = ($opener + 1);
        $defaultStart = null;
        $equalToken = null;
        $paramCount = 0;
        $passByReference = false;
        $referenceToken = false;
        $variableLength = false;
        $variadicToken = false;
        $typeHint = '';
        $typeHintToken = false;
        $typeHintEndToken = false;
        $nullableType = false;
        $visibilityToken = null;

        for ($i = $paramStart; $i <= $closer; ++$i) {
            // Check to see if this token has a parenthesis or bracket opener. If it does
            // it's likely to be an array which might have arguments in it. This
            // could cause problems in our parsing below, so lets just skip to the
            // end of it.
            if (true === isset($this->tokens[$i]['parenthesis_opener'])) {
                // Don't do this if it's the close parenthesis for the method.
                if ($i !== $this->tokens[$i]['parenthesis_closer']) {
                    $i = ($this->tokens[$i]['parenthesis_closer'] + 1);
                }
            }

            if (true === isset($this->tokens[$i]['bracket_opener'])) {
                // Don't do this if it's the close parenthesis for the method.
                if ($i !== $this->tokens[$i]['bracket_closer']) {
                    $i = ($this->tokens[$i]['bracket_closer'] + 1);
                }
            }

            switch ($this->tokens[$i]['code']) {
            case T_BITWISE_AND:
                if (null === $defaultStart) {
                    $passByReference = true;
                    $referenceToken = $i;
                }

                break;
            case T_VARIABLE:
                $currVar = $i;

                break;
            case T_ELLIPSIS:
                $variableLength = true;
                $variadicToken = $i;

                break;
            case T_CALLABLE:
                if (false === $typeHintToken) {
                    $typeHintToken = $i;
                }

                $typeHint .= $this->tokens[$i]['content'];
                $typeHintEndToken = $i;

                break;
            case T_SELF:
            case T_PARENT:
            case T_STATIC:
                // Self and parent are valid, static invalid, but was probably intended as type hint.
                if (false === isset($defaultStart)) {
                    if (false === $typeHintToken) {
                        $typeHintToken = $i;
                    }

                    $typeHint .= $this->tokens[$i]['content'];
                    $typeHintEndToken = $i;
                }

                break;
            case T_STRING:
                // This is a string, so it may be a type hint, but it could
                // also be a constant used as a default value.
                $prevComma = false;
                for ($t = $i; $t >= $opener; --$t) {
                    if (T_COMMA === $this->tokens[$t]['code']) {
                        $prevComma = $t;

                        break;
                    }
                }

                if (false !== $prevComma) {
                    $nextEquals = false;
                    for ($t = $prevComma; $t < $i; ++$t) {
                        if (T_EQUAL === $this->tokens[$t]['code']) {
                            $nextEquals = $t;

                            break;
                        }
                    }

                    if (false !== $nextEquals) {
                        break;
                    }
                }

                if (null === $defaultStart) {
                    if (false === $typeHintToken) {
                        $typeHintToken = $i;
                    }

                    $typeHint .= $this->tokens[$i]['content'];
                    $typeHintEndToken = $i;
                }

                break;
            case T_NAMESPACE:
            case T_NS_SEPARATOR:
            case T_TYPE_UNION:
            case T_FALSE:
            case T_NULL:
                // Part of a type hint or default value.
                if (null === $defaultStart) {
                    if (false === $typeHintToken) {
                        $typeHintToken = $i;
                    }

                    $typeHint .= $this->tokens[$i]['content'];
                    $typeHintEndToken = $i;
                }

                break;
            case T_NULLABLE:
                if (null === $defaultStart) {
                    $nullableType = true;
                    $typeHint .= $this->tokens[$i]['content'];
                    $typeHintEndToken = $i;
                }

                break;
            case T_PUBLIC:
            case T_PROTECTED:
            case T_PRIVATE:
                if (null === $defaultStart) {
                    $visibilityToken = $i;
                }

                break;
            case T_CLOSE_PARENTHESIS:
            case T_COMMA:
                // If it's null, then there must be no parameters for this
                // method.
                if (null === $currVar) {
                    continue 2;
                }

                $vars[$paramCount] = [];
                $vars[$paramCount]['token'] = $currVar;
                $vars[$paramCount]['name'] = $this->tokens[$currVar]['content'];
                $vars[$paramCount]['content'] = trim($this->getTokensAsString($paramStart, ($i - $paramStart)));

                if (null !== $defaultStart) {
                    $vars[$paramCount]['default'] = trim($this->getTokensAsString($defaultStart, ($i - $defaultStart)));
                    $vars[$paramCount]['default_token'] = $defaultStart;
                    $vars[$paramCount]['default_equal_token'] = $equalToken;
                }

                $vars[$paramCount]['pass_by_reference'] = $passByReference;
                $vars[$paramCount]['reference_token'] = $referenceToken;
                $vars[$paramCount]['variable_length'] = $variableLength;
                $vars[$paramCount]['variadic_token'] = $variadicToken;
                $vars[$paramCount]['type_hint'] = $typeHint;
                $vars[$paramCount]['type_hint_token'] = $typeHintToken;
                $vars[$paramCount]['type_hint_end_token'] = $typeHintEndToken;
                $vars[$paramCount]['nullable_type'] = $nullableType;

                if (null !== $visibilityToken) {
                    $vars[$paramCount]['property_visibility'] = $this->tokens[$visibilityToken]['content'];
                    $vars[$paramCount]['visibility_token'] = $visibilityToken;
                }

                if (T_COMMA === $this->tokens[$i]['code']) {
                    $vars[$paramCount]['comma_token'] = $i;
                } else {
                    $vars[$paramCount]['comma_token'] = false;
                }

                // Reset the vars, as we are about to process the next parameter.
                $currVar = null;
                $paramStart = ($i + 1);
                $defaultStart = null;
                $equalToken = null;
                $passByReference = false;
                $referenceToken = false;
                $variableLength = false;
                $variadicToken = false;
                $typeHint = '';
                $typeHintToken = false;
                $typeHintEndToken = false;
                $nullableType = false;
                $visibilityToken = null;

                ++$paramCount;

                break;
            case T_EQUAL:
                $defaultStart = $this->findNext(Util\Tokens::$emptyTokens, ($i + 1), null, true);
                $equalToken = $i;

                break;
            }//end switch
        }//end for

        return $vars;
    }

    //end getMethodParameters()

    /**
     * Returns the visibility and implementation properties of a method.
     *
     * The format of the return value is:
     * <code>
     *   array(
     *    'scope'                 => 'public', // Public, private, or protected
     *    'scope_specified'       => true,     // TRUE if the scope keyword was found.
     *    'return_type'           => '',       // The return type of the method.
     *    'return_type_token'     => integer,  // The stack pointer to the start of the return type
     *                                         // or FALSE if there is no return type.
     *    'return_type_end_token' => integer,  // The stack pointer to the end of the return type
     *                                         // or FALSE if there is no return type.
     *    'nullable_return_type'  => false,    // TRUE if the return type is preceded by the
     *                                         // nullability operator.
     *    'is_abstract'           => false,    // TRUE if the abstract keyword was found.
     *    'is_final'              => false,    // TRUE if the final keyword was found.
     *    'is_static'             => false,    // TRUE if the static keyword was found.
     *    'has_body'              => false,    // TRUE if the method has a body
     *   );
     * </code>
     *
     * @param int $stackPtr The position in the stack of the function token to
     *                      acquire the properties for.
     *
     * @return array
     *
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException If the specified position is not a
     *                                                      T_FUNCTION, T_CLOSURE, or T_FN token.
     */
    public function getMethodProperties($stackPtr)
    {
        if (T_FUNCTION !== $this->tokens[$stackPtr]['code']
            && T_CLOSURE !== $this->tokens[$stackPtr]['code']
            && T_FN !== $this->tokens[$stackPtr]['code']
        ) {
            throw new RuntimeException('$stackPtr must be of type T_FUNCTION or T_CLOSURE or T_FN');
        }

        if (T_FUNCTION === $this->tokens[$stackPtr]['code']) {
            $valid = [
                T_PUBLIC => T_PUBLIC,
                T_PRIVATE => T_PRIVATE,
                T_PROTECTED => T_PROTECTED,
                T_STATIC => T_STATIC,
                T_FINAL => T_FINAL,
                T_ABSTRACT => T_ABSTRACT,
                T_WHITESPACE => T_WHITESPACE,
                T_COMMENT => T_COMMENT,
                T_DOC_COMMENT => T_DOC_COMMENT,
            ];
        } else {
            $valid = [
                T_STATIC => T_STATIC,
                T_WHITESPACE => T_WHITESPACE,
                T_COMMENT => T_COMMENT,
                T_DOC_COMMENT => T_DOC_COMMENT,
            ];
        }

        $scope = 'public';
        $scopeSpecified = false;
        $isAbstract = false;
        $isFinal = false;
        $isStatic = false;

        for ($i = ($stackPtr - 1); $i > 0; --$i) {
            if (false === isset($valid[$this->tokens[$i]['code']])) {
                break;
            }

            switch ($this->tokens[$i]['code']) {
            case T_PUBLIC:
                $scope = 'public';
                $scopeSpecified = true;

                break;
            case T_PRIVATE:
                $scope = 'private';
                $scopeSpecified = true;

                break;
            case T_PROTECTED:
                $scope = 'protected';
                $scopeSpecified = true;

                break;
            case T_ABSTRACT:
                $isAbstract = true;

                break;
            case T_FINAL:
                $isFinal = true;

                break;
            case T_STATIC:
                $isStatic = true;

                break;
            }//end switch
        }//end for

        $returnType = '';
        $returnTypeToken = false;
        $returnTypeEndToken = false;
        $nullableReturnType = false;
        $hasBody = true;

        if (true === isset($this->tokens[$stackPtr]['parenthesis_closer'])) {
            $scopeOpener = null;
            if (true === isset($this->tokens[$stackPtr]['scope_opener'])) {
                $scopeOpener = $this->tokens[$stackPtr]['scope_opener'];
            }

            $valid = [
                T_STRING => T_STRING,
                T_CALLABLE => T_CALLABLE,
                T_SELF => T_SELF,
                T_PARENT => T_PARENT,
                T_STATIC => T_STATIC,
                T_FALSE => T_FALSE,
                T_NULL => T_NULL,
                T_NAMESPACE => T_NAMESPACE,
                T_NS_SEPARATOR => T_NS_SEPARATOR,
                T_TYPE_UNION => T_TYPE_UNION,
            ];

            for ($i = $this->tokens[$stackPtr]['parenthesis_closer']; $i < $this->numTokens; ++$i) {
                if ((null === $scopeOpener && T_SEMICOLON === $this->tokens[$i]['code'])
                    || (null !== $scopeOpener && $i === $scopeOpener)
                ) {
                    // End of function definition.
                    break;
                }

                if (T_NULLABLE === $this->tokens[$i]['code']) {
                    $nullableReturnType = true;
                }

                if (true === isset($valid[$this->tokens[$i]['code']])) {
                    if (false === $returnTypeToken) {
                        $returnTypeToken = $i;
                    }

                    $returnType .= $this->tokens[$i]['content'];
                    $returnTypeEndToken = $i;
                }
            }//end for

            if (T_FN === $this->tokens[$stackPtr]['code']) {
                $bodyToken = T_FN_ARROW;
            } else {
                $bodyToken = T_OPEN_CURLY_BRACKET;
            }

            $end = $this->findNext([$bodyToken, T_SEMICOLON], $this->tokens[$stackPtr]['parenthesis_closer']);
            $hasBody = $this->tokens[$end]['code'] === $bodyToken;
        }//end if

        if ('' !== $returnType && true === $nullableReturnType) {
            $returnType = '?' . $returnType;
        }

        return [
            'scope' => $scope,
            'scope_specified' => $scopeSpecified,
            'return_type' => $returnType,
            'return_type_token' => $returnTypeToken,
            'return_type_end_token' => $returnTypeEndToken,
            'nullable_return_type' => $nullableReturnType,
            'is_abstract' => $isAbstract,
            'is_final' => $isFinal,
            'is_static' => $isStatic,
            'has_body' => $hasBody,
        ];
    }

    //end getMethodProperties()

    /**
     * Returns the visibility and implementation properties of a class member var.
     *
     * The format of the return value is:
     *
     * <code>
     *   array(
     *    'scope'           => string,  // Public, private, or protected.
     *    'scope_specified' => boolean, // TRUE if the scope was explicitly specified.
     *    'is_static'       => boolean, // TRUE if the static keyword was found.
     *    'type'            => string,  // The type of the var (empty if no type specified).
     *    'type_token'      => integer, // The stack pointer to the start of the type
     *                                  // or FALSE if there is no type.
     *    'type_end_token'  => integer, // The stack pointer to the end of the type
     *                                  // or FALSE if there is no type.
     *    'nullable_type'   => boolean, // TRUE if the type is preceded by the nullability
     *                                  // operator.
     *   );
     * </code>
     *
     * @param int $stackPtr The position in the stack of the T_VARIABLE token to
     *                      acquire the properties for.
     *
     * @return array
     *
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException If the specified position is not a
     *                                                      T_VARIABLE token, or if the position is not
     *                                                      a class member variable.
     */
    public function getMemberProperties($stackPtr)
    {
        if (T_VARIABLE !== $this->tokens[$stackPtr]['code']) {
            throw new RuntimeException('$stackPtr must be of type T_VARIABLE');
        }

        $conditions = array_keys($this->tokens[$stackPtr]['conditions']);
        $ptr = array_pop($conditions);
        if (false === isset($this->tokens[$ptr])
            || (T_CLASS !== $this->tokens[$ptr]['code']
            && T_ANON_CLASS !== $this->tokens[$ptr]['code']
            && T_TRAIT !== $this->tokens[$ptr]['code'])
        ) {
            if (true === isset($this->tokens[$ptr])
                && T_INTERFACE === $this->tokens[$ptr]['code']
            ) {
                // T_VARIABLEs in interfaces can actually be method arguments
                // but they wont be seen as being inside the method because there
                // are no scope openers and closers for abstract methods. If it is in
                // parentheses, we can be pretty sure it is a method argument.
                if (false === isset($this->tokens[$stackPtr]['nested_parenthesis'])
                    || true === empty($this->tokens[$stackPtr]['nested_parenthesis'])
                ) {
                    $error = 'Possible parse error: interfaces may not include member vars';
                    $this->addWarning($error, $stackPtr, 'Internal.ParseError.InterfaceHasMemberVar');

                    return [];
                }
            } else {
                throw new RuntimeException('$stackPtr is not a class member var');
            }
        }

        // Make sure it's not a method parameter.
        if (false === empty($this->tokens[$stackPtr]['nested_parenthesis'])) {
            $parenthesis = array_keys($this->tokens[$stackPtr]['nested_parenthesis']);
            $deepestOpen = array_pop($parenthesis);
            if ($deepestOpen > $ptr
                && true === isset($this->tokens[$deepestOpen]['parenthesis_owner'])
                && T_FUNCTION === $this->tokens[$this->tokens[$deepestOpen]['parenthesis_owner']]['code']
            ) {
                throw new RuntimeException('$stackPtr is not a class member var');
            }
        }

        $valid = [
            T_PUBLIC => T_PUBLIC,
            T_PRIVATE => T_PRIVATE,
            T_PROTECTED => T_PROTECTED,
            T_STATIC => T_STATIC,
            T_VAR => T_VAR,
        ];

        $valid += Util\Tokens::$emptyTokens;

        $scope = 'public';
        $scopeSpecified = false;
        $isStatic = false;

        $startOfStatement = $this->findPrevious(
            [
                T_SEMICOLON,
                T_OPEN_CURLY_BRACKET,
                T_CLOSE_CURLY_BRACKET,
            ],
            ($stackPtr - 1)
        );

        for ($i = ($startOfStatement + 1); $i < $stackPtr; ++$i) {
            if (false === isset($valid[$this->tokens[$i]['code']])) {
                break;
            }

            switch ($this->tokens[$i]['code']) {
            case T_PUBLIC:
                $scope = 'public';
                $scopeSpecified = true;

                break;
            case T_PRIVATE:
                $scope = 'private';
                $scopeSpecified = true;

                break;
            case T_PROTECTED:
                $scope = 'protected';
                $scopeSpecified = true;

                break;
            case T_STATIC:
                $isStatic = true;

                break;
            }
        }//end for

        $type = '';
        $typeToken = false;
        $typeEndToken = false;
        $nullableType = false;

        if ($i < $stackPtr) {
            // We've found a type.
            $valid = [
                T_STRING => T_STRING,
                T_CALLABLE => T_CALLABLE,
                T_SELF => T_SELF,
                T_PARENT => T_PARENT,
                T_FALSE => T_FALSE,
                T_NULL => T_NULL,
                T_NAMESPACE => T_NAMESPACE,
                T_NS_SEPARATOR => T_NS_SEPARATOR,
                T_TYPE_UNION => T_TYPE_UNION,
            ];

            for ($i; $i < $stackPtr; ++$i) {
                if (T_VARIABLE === $this->tokens[$i]['code']) {
                    // Hit another variable in a group definition.
                    break;
                }

                if (T_NULLABLE === $this->tokens[$i]['code']) {
                    $nullableType = true;
                }

                if (true === isset($valid[$this->tokens[$i]['code']])) {
                    $typeEndToken = $i;
                    if (false === $typeToken) {
                        $typeToken = $i;
                    }

                    $type .= $this->tokens[$i]['content'];
                }
            }

            if ('' !== $type && true === $nullableType) {
                $type = '?' . $type;
            }
        }//end if

        return [
            'scope' => $scope,
            'scope_specified' => $scopeSpecified,
            'is_static' => $isStatic,
            'type' => $type,
            'type_token' => $typeToken,
            'type_end_token' => $typeEndToken,
            'nullable_type' => $nullableType,
        ];
    }

    //end getMemberProperties()

    /**
     * Returns the visibility and implementation properties of a class.
     *
     * The format of the return value is:
     * <code>
     *   array(
     *    'is_abstract' => false, // true if the abstract keyword was found.
     *    'is_final'    => false, // true if the final keyword was found.
     *   );
     * </code>
     *
     * @param int $stackPtr The position in the stack of the T_CLASS token to
     *                      acquire the properties for.
     *
     * @return array
     *
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException If the specified position is not a
     *                                                      T_CLASS token.
     */
    public function getClassProperties($stackPtr)
    {
        if (T_CLASS !== $this->tokens[$stackPtr]['code']) {
            throw new RuntimeException('$stackPtr must be of type T_CLASS');
        }

        $valid = [
            T_FINAL => T_FINAL,
            T_ABSTRACT => T_ABSTRACT,
            T_WHITESPACE => T_WHITESPACE,
            T_COMMENT => T_COMMENT,
            T_DOC_COMMENT => T_DOC_COMMENT,
        ];

        $isAbstract = false;
        $isFinal = false;

        for ($i = ($stackPtr - 1); $i > 0; --$i) {
            if (false === isset($valid[$this->tokens[$i]['code']])) {
                break;
            }

            switch ($this->tokens[$i]['code']) {
            case T_ABSTRACT:
                $isAbstract = true;

                break;
            case T_FINAL:
                $isFinal = true;

                break;
            }
        }//end for

        return [
            'is_abstract' => $isAbstract,
            'is_final' => $isFinal,
        ];
    }

    //end getClassProperties()

    /**
     * Determine if the passed token is a reference operator.
     *
     * Returns true if the specified token position represents a reference.
     * Returns false if the token represents a bitwise operator.
     *
     * @param int $stackPtr The position of the T_BITWISE_AND token.
     *
     * @return bool
     */
    public function isReference($stackPtr)
    {
        if (T_BITWISE_AND !== $this->tokens[$stackPtr]['code']) {
            return false;
        }

        $tokenBefore = $this->findPrevious(
            Util\Tokens::$emptyTokens,
            ($stackPtr - 1),
            null,
            true
        );

        if (T_FUNCTION === $this->tokens[$tokenBefore]['code']
            || T_CLOSURE === $this->tokens[$tokenBefore]['code']
            || T_FN === $this->tokens[$tokenBefore]['code']
        ) {
            // Function returns a reference.
            return true;
        }

        if (T_DOUBLE_ARROW === $this->tokens[$tokenBefore]['code']) {
            // Inside a foreach loop or array assignment, this is a reference.
            return true;
        }

        if (T_AS === $this->tokens[$tokenBefore]['code']) {
            // Inside a foreach loop, this is a reference.
            return true;
        }

        if (true === isset(Util\Tokens::$assignmentTokens[$this->tokens[$tokenBefore]['code']])) {
            // This is directly after an assignment. It's a reference. Even if
            // it is part of an operation, the other tests will handle it.
            return true;
        }

        $tokenAfter = $this->findNext(
            Util\Tokens::$emptyTokens,
            ($stackPtr + 1),
            null,
            true
        );

        if (T_NEW === $this->tokens[$tokenAfter]['code']) {
            return true;
        }

        if (true === isset($this->tokens[$stackPtr]['nested_parenthesis'])) {
            $brackets = $this->tokens[$stackPtr]['nested_parenthesis'];
            $lastBracket = array_pop($brackets);
            if (true === isset($this->tokens[$lastBracket]['parenthesis_owner'])) {
                $owner = $this->tokens[$this->tokens[$lastBracket]['parenthesis_owner']];
                if (T_FUNCTION === $owner['code']
                    || T_CLOSURE === $owner['code']
                    || T_FN === $owner['code']
                ) {
                    $params = $this->getMethodParameters($this->tokens[$lastBracket]['parenthesis_owner']);
                    foreach ($params as $param) {
                        if ($param['reference_token'] === $stackPtr) {
                            // Function parameter declared to be passed by reference.
                            return true;
                        }
                    }
                }//end if
            } else {
                $prev = false;
                for ($t = ($this->tokens[$lastBracket]['parenthesis_opener'] - 1); $t >= 0; --$t) {
                    if (T_WHITESPACE !== $this->tokens[$t]['code']) {
                        $prev = $t;

                        break;
                    }
                }

                if (false !== $prev && T_USE === $this->tokens[$prev]['code']) {
                    // Closure use by reference.
                    return true;
                }
            }//end if
        }//end if

        // Pass by reference in function calls and assign by reference in arrays.
        if (T_OPEN_PARENTHESIS === $this->tokens[$tokenBefore]['code']
            || T_COMMA === $this->tokens[$tokenBefore]['code']
            || T_OPEN_SHORT_ARRAY === $this->tokens[$tokenBefore]['code']
        ) {
            if (T_VARIABLE === $this->tokens[$tokenAfter]['code']) {
                return true;
            }
            $skip = Util\Tokens::$emptyTokens;
            $skip[] = T_NS_SEPARATOR;
            $skip[] = T_SELF;
            $skip[] = T_PARENT;
            $skip[] = T_STATIC;
            $skip[] = T_STRING;
            $skip[] = T_NAMESPACE;
            $skip[] = T_DOUBLE_COLON;

            $nextSignificantAfter = $this->findNext(
                $skip,
                ($stackPtr + 1),
                null,
                true
            );
            if (T_VARIABLE === $this->tokens[$nextSignificantAfter]['code']) {
                return true;
            }
            //end if
        }//end if

        return false;
    }

    //end isReference()

    /**
     * Returns the content of the tokens from the specified start position in
     * the token stack for the specified length.
     *
     * @param int  $start       The position to start from in the token stack.
     * @param int  $length      The length of tokens to traverse from the start pos.
     * @param bool $origContent Whether the original content or the tab replaced
     *                          content should be used.
     *
     * @return string The token contents.
     *
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException If the specified position does not exist.
     */
    public function getTokensAsString($start, $length, $origContent = false)
    {
        if (false === \is_int($start) || false === isset($this->tokens[$start])) {
            throw new RuntimeException('The $start position for getTokensAsString() must exist in the token stack');
        }

        if (false === \is_int($length) || $length <= 0) {
            return '';
        }

        $str = '';
        $end = ($start + $length);
        if ($end > $this->numTokens) {
            $end = $this->numTokens;
        }

        for ($i = $start; $i < $end; ++$i) {
            // If tabs are being converted to spaces by the tokeniser, the
            // original content should be used instead of the converted content.
            if (true === $origContent && true === isset($this->tokens[$i]['orig_content'])) {
                $str .= $this->tokens[$i]['orig_content'];
            } else {
                $str .= $this->tokens[$i]['content'];
            }
        }

        return $str;
    }

    //end getTokensAsString()

    /**
     * Returns the position of the previous specified token(s).
     *
     * If a value is specified, the previous token of the specified type(s)
     * containing the specified value will be returned.
     *
     * Returns false if no token can be found.
     *
     * @param array|int|string $types   The type(s) of tokens to search for.
     * @param int              $start   The position to start searching from in the
     *                                  token stack.
     * @param null|int         $end     The end position to fail if no token is found.
     *                                  if not specified or null, end will default to
     *                                  the start of the token stack.
     * @param bool             $exclude If true, find the previous token that is NOT of
     *                                  the types specified in $types.
     * @param null|string      $value   The value that the token(s) must be equal to.
     *                                  If value is omitted, tokens with any value will
     *                                  be returned.
     * @param bool             $local   If true, tokens outside the current statement
     *                                  will not be checked. IE. checking will stop
     *                                  at the previous semi-colon found.
     *
     * @return false|int
     *
     * @see    findNext()
     */
    public function findPrevious(
        $types,
        $start,
        $end = null,
        $exclude = false,
        $value = null,
        $local = false
    ) {
        $types = (array)$types;

        if (null === $end) {
            $end = 0;
        }

        for ($i = $start; $i >= $end; --$i) {
            $found = (bool)$exclude;
            foreach ($types as $type) {
                if ($this->tokens[$i]['code'] === $type) {
                    $found = !$exclude;

                    break;
                }
            }

            if (true === $found) {
                if (null === $value) {
                    return $i;
                }
                if ($this->tokens[$i]['content'] === $value) {
                    return $i;
                }
            }

            if (true === $local) {
                if (true === isset($this->tokens[$i]['scope_opener'])
                    && $i === $this->tokens[$i]['scope_closer']
                ) {
                    $i = $this->tokens[$i]['scope_opener'];
                } elseif (true === isset($this->tokens[$i]['bracket_opener'])
                    && $i === $this->tokens[$i]['bracket_closer']
                ) {
                    $i = $this->tokens[$i]['bracket_opener'];
                } elseif (true === isset($this->tokens[$i]['parenthesis_opener'])
                    && $i === $this->tokens[$i]['parenthesis_closer']
                ) {
                    $i = $this->tokens[$i]['parenthesis_opener'];
                } elseif (T_SEMICOLON === $this->tokens[$i]['code']) {
                    break;
                }
            }
        }//end for

        return false;
    }

    //end findPrevious()

    /**
     * Returns the position of the next specified token(s).
     *
     * If a value is specified, the next token of the specified type(s)
     * containing the specified value will be returned.
     *
     * Returns false if no token can be found.
     *
     * @param array|int|string $types   The type(s) of tokens to search for.
     * @param int              $start   The position to start searching from in the
     *                                  token stack.
     * @param null|int         $end     The end position to fail if no token is found.
     *                                  if not specified or null, end will default to
     *                                  the end of the token stack.
     * @param bool             $exclude If true, find the next token that is NOT of
     *                                  a type specified in $types.
     * @param null|string      $value   The value that the token(s) must be equal to.
     *                                  If value is omitted, tokens with any value will
     *                                  be returned.
     * @param bool             $local   If true, tokens outside the current statement
     *                                  will not be checked. i.e., checking will stop
     *                                  at the next semi-colon found.
     *
     * @return false|int
     *
     * @see    findPrevious()
     */
    public function findNext(
        $types,
        $start,
        $end = null,
        $exclude = false,
        $value = null,
        $local = false
    ) {
        $types = (array)$types;

        if (null === $end || $end > $this->numTokens) {
            $end = $this->numTokens;
        }

        for ($i = $start; $i < $end; ++$i) {
            $found = (bool)$exclude;
            foreach ($types as $type) {
                if ($this->tokens[$i]['code'] === $type) {
                    $found = !$exclude;

                    break;
                }
            }

            if (true === $found) {
                if (null === $value) {
                    return $i;
                }
                if ($this->tokens[$i]['content'] === $value) {
                    return $i;
                }
            }

            if (true === $local && T_SEMICOLON === $this->tokens[$i]['code']) {
                break;
            }
        }//end for

        return false;
    }

    //end findNext()

    /**
     * Returns the position of the first non-whitespace token in a statement.
     *
     * @param int              $start  The position to start searching from in the token stack.
     * @param array|int|string $ignore Token types that should not be considered stop points.
     *
     * @return int
     */
    public function findStartOfStatement($start, $ignore = null)
    {
        $endTokens = Util\Tokens::$blockOpeners;

        $endTokens[T_COLON] = true;
        $endTokens[T_COMMA] = true;
        $endTokens[T_DOUBLE_ARROW] = true;
        $endTokens[T_SEMICOLON] = true;
        $endTokens[T_OPEN_TAG] = true;
        $endTokens[T_CLOSE_TAG] = true;
        $endTokens[T_OPEN_SHORT_ARRAY] = true;

        if (null !== $ignore) {
            $ignore = (array)$ignore;
            foreach ($ignore as $code) {
                unset($endTokens[$code]);
            }
        }

        $lastNotEmpty = $start;

        for ($i = $start; $i >= 0; --$i) {
            if (true === isset($endTokens[$this->tokens[$i]['code']])) {
                // Found the end of the previous statement.
                return $lastNotEmpty;
            }

            if (true === isset($this->tokens[$i]['scope_opener'])
                && $i === $this->tokens[$i]['scope_closer']
                && T_CLOSE_PARENTHESIS !== $this->tokens[$i]['code']
                && T_END_NOWDOC !== $this->tokens[$i]['code']
                && T_END_HEREDOC !== $this->tokens[$i]['code']
            ) {
                // Found the end of the previous scope block.
                return $lastNotEmpty;
            }

            // Skip nested statements.
            if (true === isset($this->tokens[$i]['bracket_opener'])
                && $i === $this->tokens[$i]['bracket_closer']
            ) {
                $i = $this->tokens[$i]['bracket_opener'];
            } elseif (true === isset($this->tokens[$i]['parenthesis_opener'])
                && $i === $this->tokens[$i]['parenthesis_closer']
            ) {
                $i = $this->tokens[$i]['parenthesis_opener'];
            }

            if (false === isset(Util\Tokens::$emptyTokens[$this->tokens[$i]['code']])) {
                $lastNotEmpty = $i;
            }
        }//end for

        return 0;
    }

    //end findStartOfStatement()

    /**
     * Returns the position of the last non-whitespace token in a statement.
     *
     * @param int              $start  The position to start searching from in the token stack.
     * @param array|int|string $ignore Token types that should not be considered stop points.
     *
     * @return int
     */
    public function findEndOfStatement($start, $ignore = null)
    {
        $endTokens = [
            T_COLON => true,
            T_COMMA => true,
            T_DOUBLE_ARROW => true,
            T_SEMICOLON => true,
            T_CLOSE_PARENTHESIS => true,
            T_CLOSE_SQUARE_BRACKET => true,
            T_CLOSE_CURLY_BRACKET => true,
            T_CLOSE_SHORT_ARRAY => true,
            T_OPEN_TAG => true,
            T_CLOSE_TAG => true,
        ];

        if (null !== $ignore) {
            $ignore = (array)$ignore;
            foreach ($ignore as $code) {
                unset($endTokens[$code]);
            }
        }

        $lastNotEmpty = $start;
        for ($i = $start; $i < $this->numTokens; ++$i) {
            if ($i !== $start && true === isset($endTokens[$this->tokens[$i]['code']])) {
                // Found the end of the statement.
                if (T_CLOSE_PARENTHESIS === $this->tokens[$i]['code']
                    || T_CLOSE_SQUARE_BRACKET === $this->tokens[$i]['code']
                    || T_CLOSE_CURLY_BRACKET === $this->tokens[$i]['code']
                    || T_CLOSE_SHORT_ARRAY === $this->tokens[$i]['code']
                    || T_OPEN_TAG === $this->tokens[$i]['code']
                    || T_CLOSE_TAG === $this->tokens[$i]['code']
                ) {
                    return $lastNotEmpty;
                }

                return $i;
            }

            // Skip nested statements.
            if (true === isset($this->tokens[$i]['scope_closer'])
                && ($i === $this->tokens[$i]['scope_opener']
                || $i === $this->tokens[$i]['scope_condition'])
            ) {
                if (T_FN === $this->tokens[$i]['code']) {
                    $lastNotEmpty = $this->tokens[$i]['scope_closer'];
                    $i = ($this->tokens[$i]['scope_closer'] - 1);

                    continue;
                }

                if ($i === $start && true === isset(Util\Tokens::$scopeOpeners[$this->tokens[$i]['code']])) {
                    return $this->tokens[$i]['scope_closer'];
                }

                $i = $this->tokens[$i]['scope_closer'];
            } elseif (true === isset($this->tokens[$i]['bracket_closer'])
                && $i === $this->tokens[$i]['bracket_opener']
            ) {
                $i = $this->tokens[$i]['bracket_closer'];
            } elseif (true === isset($this->tokens[$i]['parenthesis_closer'])
                && $i === $this->tokens[$i]['parenthesis_opener']
            ) {
                $i = $this->tokens[$i]['parenthesis_closer'];
            } elseif (T_OPEN_USE_GROUP === $this->tokens[$i]['code']) {
                $end = $this->findNext(T_CLOSE_USE_GROUP, ($i + 1));
                if (false !== $end) {
                    $i = $end;
                }
            }//end if

            if (false === isset(Util\Tokens::$emptyTokens[$this->tokens[$i]['code']])) {
                $lastNotEmpty = $i;
            }
        }//end for

        return $this->numTokens - 1;
    }

    //end findEndOfStatement()

    /**
     * Returns the position of the first token on a line, matching given type.
     *
     * Returns false if no token can be found.
     *
     * @param array|int|string $types   The type(s) of tokens to search for.
     * @param int              $start   The position to start searching from in the
     *                                  token stack. The first token matching on
     *                                  this line before this token will be returned.
     * @param bool             $exclude If true, find the token that is NOT of
     *                                  the types specified in $types.
     * @param string           $value   The value that the token must be equal to.
     *                                  If value is omitted, tokens with any value will
     *                                  be returned.
     *
     * @return false|int
     */
    public function findFirstOnLine($types, $start, $exclude = false, $value = null)
    {
        if (false === \is_array($types)) {
            $types = [$types];
        }

        $foundToken = false;

        for ($i = $start; $i >= 0; --$i) {
            if ($this->tokens[$i]['line'] < $this->tokens[$start]['line']) {
                break;
            }

            $found = $exclude;
            foreach ($types as $type) {
                if (false === $exclude) {
                    if ($this->tokens[$i]['code'] === $type) {
                        $found = true;

                        break;
                    }
                } else {
                    if ($this->tokens[$i]['code'] === $type) {
                        $found = false;

                        break;
                    }
                }
            }

            if (true === $found) {
                if (null === $value) {
                    $foundToken = $i;
                } elseif ($this->tokens[$i]['content'] === $value) {
                    $foundToken = $i;
                }
            }
        }//end for

        return $foundToken;
    }

    //end findFirstOnLine()

    /**
     * Determine if the passed token has a condition of one of the passed types.
     *
     * @param int              $stackPtr The position of the token we are checking.
     * @param array|int|string $types    The type(s) of tokens to search for.
     *
     * @return bool
     */
    public function hasCondition($stackPtr, $types)
    {
        // Check for the existence of the token.
        if (false === isset($this->tokens[$stackPtr])) {
            return false;
        }

        // Make sure the token has conditions.
        if (false === isset($this->tokens[$stackPtr]['conditions'])) {
            return false;
        }

        $types = (array)$types;
        $conditions = $this->tokens[$stackPtr]['conditions'];

        foreach ($types as $type) {
            if (true === \in_array($type, $conditions, true)) {
                // We found a token with the required type.
                return true;
            }
        }

        return false;
    }

    //end hasCondition()

    /**
     * Return the position of the condition for the passed token.
     *
     * Returns FALSE if the token does not have the condition.
     *
     * @param int        $stackPtr The position of the token we are checking.
     * @param int|string $type     The type of token to search for.
     * @param bool       $first    If TRUE, will return the matched condition
     *                             furthest away from the passed token.
     *                             If FALSE, will return the matched condition
     *                             closest to the passed token.
     *
     * @return false|int
     */
    public function getCondition($stackPtr, $type, $first = true)
    {
        // Check for the existence of the token.
        if (false === isset($this->tokens[$stackPtr])) {
            return false;
        }

        // Make sure the token has conditions.
        if (false === isset($this->tokens[$stackPtr]['conditions'])) {
            return false;
        }

        $conditions = $this->tokens[$stackPtr]['conditions'];
        if (false === $first) {
            $conditions = array_reverse($conditions, true);
        }

        foreach ($conditions as $token => $condition) {
            if ($condition === $type) {
                return $token;
            }
        }

        return false;
    }

    //end getCondition()

    /**
     * Returns the name of the class that the specified class extends.
     * (works for classes, anonymous classes and interfaces)
     *
     * Returns FALSE on error or if there is no extended class name.
     *
     * @param int $stackPtr The stack position of the class.
     *
     * @return false|string
     */
    public function findExtendedClassName($stackPtr)
    {
        // Check for the existence of the token.
        if (false === isset($this->tokens[$stackPtr])) {
            return false;
        }

        if (T_CLASS !== $this->tokens[$stackPtr]['code']
            && T_ANON_CLASS !== $this->tokens[$stackPtr]['code']
            && T_INTERFACE !== $this->tokens[$stackPtr]['code']
        ) {
            return false;
        }

        if (false === isset($this->tokens[$stackPtr]['scope_opener'])) {
            return false;
        }

        $classOpenerIndex = $this->tokens[$stackPtr]['scope_opener'];
        $extendsIndex = $this->findNext(T_EXTENDS, $stackPtr, $classOpenerIndex);
        if (false === $extendsIndex) {
            return false;
        }

        $find = [
            T_NS_SEPARATOR,
            T_STRING,
            T_WHITESPACE,
        ];

        $end = $this->findNext($find, ($extendsIndex + 1), ($classOpenerIndex + 1), true);
        $name = $this->getTokensAsString(($extendsIndex + 1), ($end - $extendsIndex - 1));
        $name = trim($name);

        if ('' === $name) {
            return false;
        }

        return $name;
    }

    //end findExtendedClassName()

    /**
     * Returns the names of the interfaces that the specified class implements.
     *
     * Returns FALSE on error or if there are no implemented interface names.
     *
     * @param int $stackPtr The stack position of the class.
     *
     * @return array|false
     */
    public function findImplementedInterfaceNames($stackPtr)
    {
        // Check for the existence of the token.
        if (false === isset($this->tokens[$stackPtr])) {
            return false;
        }

        if (T_CLASS !== $this->tokens[$stackPtr]['code']
            && T_ANON_CLASS !== $this->tokens[$stackPtr]['code']
        ) {
            return false;
        }

        if (false === isset($this->tokens[$stackPtr]['scope_closer'])) {
            return false;
        }

        $classOpenerIndex = $this->tokens[$stackPtr]['scope_opener'];
        $implementsIndex = $this->findNext(T_IMPLEMENTS, $stackPtr, $classOpenerIndex);
        if (false === $implementsIndex) {
            return false;
        }

        $find = [
            T_NS_SEPARATOR,
            T_STRING,
            T_WHITESPACE,
            T_COMMA,
        ];

        $end = $this->findNext($find, ($implementsIndex + 1), ($classOpenerIndex + 1), true);
        $name = $this->getTokensAsString(($implementsIndex + 1), ($end - $implementsIndex - 1));
        $name = trim($name);

        if ('' === $name) {
            return false;
        }
        $names = explode(',', $name);

        return array_map('trim', $names);
    }

    //end findImplementedInterfaceNames()

    /**
     * Adds an error to the error stack.
     *
     * @param bool   $error    Is this an error message?
     * @param string $message  The text of the message.
     * @param int    $line     The line on which the message occurred.
     * @param int    $column   The column at which the message occurred.
     * @param string $code     A violation code unique to the sniff message.
     * @param array  $data     Replacements for the message.
     * @param int    $severity The severity level for this message. A value of 0
     *                         will be converted into the default severity level.
     * @param bool   $fixable  Can the problem be fixed by the sniff?
     *
     * @return bool
     */
    protected function addMessage($error, $message, $line, $column, $code, $data, $severity, $fixable)
    {
        // Check if this line is ignoring all message codes.
        if (true === isset($this->tokenizer->ignoredLines[$line]['.all'])) {
            return false;
        }

        // Work out which sniff generated the message.
        $parts = explode('.', $code);
        if ('Internal' === $parts[0]) {
            // An internal message.
            $listenerCode = Util\Common::getSniffCode($this->activeListener);
            $sniffCode = $code;
            $checkCodes = [$sniffCode];
        } else {
            if ($parts[0] !== $code) {
                // The full message code has been passed in.
                $sniffCode = $code;
                $listenerCode = substr($sniffCode, 0, strrpos($sniffCode, '.'));
            } else {
                $listenerCode = Util\Common::getSniffCode($this->activeListener);
                $sniffCode = $listenerCode . '.' . $code;
                $parts = explode('.', $sniffCode);
            }

            $checkCodes = [
                $sniffCode,
                $parts[0] . '.' . $parts[1] . '.' . $parts[2],
                $parts[0] . '.' . $parts[1],
                $parts[0],
            ];
        }//end if

        if (true === isset($this->tokenizer->ignoredLines[$line])) {
            // Check if this line is ignoring this specific message.
            $ignored = false;
            foreach ($checkCodes as $checkCode) {
                if (true === isset($this->tokenizer->ignoredLines[$line][$checkCode])) {
                    $ignored = true;

                    break;
                }
            }

            // If it is ignored, make sure it's not whitelisted.
            if (true === $ignored
                && true === isset($this->tokenizer->ignoredLines[$line]['.except'])
            ) {
                foreach ($checkCodes as $checkCode) {
                    if (true === isset($this->tokenizer->ignoredLines[$line]['.except'][$checkCode])) {
                        $ignored = false;

                        break;
                    }
                }
            }

            if (true === $ignored) {
                return false;
            }
        }//end if

        $includeAll = true;
        if (false === $this->configCache['cache']
            || false === $this->configCache['recordErrors']
        ) {
            $includeAll = false;
        }

        // Filter out any messages for sniffs that shouldn't have run
        // due to the use of the --sniffs command line argument.
        if (false === $includeAll
            && ((false === empty($this->configCache['sniffs'])
            && false === \in_array(strtolower($listenerCode), $this->configCache['sniffs'], true))
            || (false === empty($this->configCache['exclude'])
            && true === \in_array(strtolower($listenerCode), $this->configCache['exclude'], true)))
        ) {
            return false;
        }

        // If we know this sniff code is being ignored for this file, return early.
        foreach ($checkCodes as $checkCode) {
            if (true === isset($this->ignoredCodes[$checkCode])) {
                return false;
            }
        }

        $oppositeType = 'warning';
        if (false === $error) {
            $oppositeType = 'error';
        }

        foreach ($checkCodes as $checkCode) {
            // Make sure this message type has not been set to the opposite message type.
            if (true === isset($this->ruleset->ruleset[$checkCode]['type'])
                && $this->ruleset->ruleset[$checkCode]['type'] === $oppositeType
            ) {
                $error = !$error;

                break;
            }
        }

        if (true === $error) {
            $configSeverity = $this->configCache['errorSeverity'];
            $messageCount = &$this->errorCount;
            $messages = &$this->errors;
        } else {
            $configSeverity = $this->configCache['warningSeverity'];
            $messageCount = &$this->warningCount;
            $messages = &$this->warnings;
        }

        if (false === $includeAll && 0 === $configSeverity) {
            // Don't bother doing any processing as these messages are just going to
            // be hidden in the reports anyway.
            return false;
        }

        if (0 === $severity) {
            $severity = 5;
        }

        foreach ($checkCodes as $checkCode) {
            // Make sure we are interested in this severity level.
            if (true === isset($this->ruleset->ruleset[$checkCode]['severity'])) {
                $severity = $this->ruleset->ruleset[$checkCode]['severity'];

                break;
            }
        }

        if (false === $includeAll && $configSeverity > $severity) {
            return false;
        }

        // Make sure we are not ignoring this file.
        $included = null;
        if ('STDIN' === trim($this->path, '\'"')) {
            $included = true;
        } else {
            foreach ($checkCodes as $checkCode) {
                $patterns = null;

                if (true === isset($this->configCache['includePatterns'][$checkCode])) {
                    $patterns = $this->configCache['includePatterns'][$checkCode];
                    $excluding = false;
                } elseif (true === isset($this->configCache['ignorePatterns'][$checkCode])) {
                    $patterns = $this->configCache['ignorePatterns'][$checkCode];
                    $excluding = true;
                }

                if (null === $patterns) {
                    continue;
                }

                foreach ($patterns as $pattern => $type) {
                    // While there is support for a type of each pattern
                    // (absolute or relative) we don't actually support it here.
                    $replacements = [
                        '\\,' => ',',
                        '*' => '.*',
                    ];

                    // We assume a / directory separator, as do the exclude rules
                    // most developers write, so we need a special case for any system
                    // that is different.
                    if (\DIRECTORY_SEPARATOR === '\\') {
                        $replacements['/'] = '\\\\';
                    }

                    $pattern = '`' . strtr($pattern, $replacements) . '`i';
                    $matched = preg_match($pattern, $this->path);

                    if (0 === $matched) {
                        if (false === $excluding && null === $included) {
                            // This file path is not being included.
                            $included = false;
                        }

                        continue;
                    }

                    if (true === $excluding) {
                        // This file path is being excluded.
                        $this->ignoredCodes[$checkCode] = true;

                        return false;
                    }

                    // This file path is being included.
                    $included = true;

                    break;
                }//end foreach
            }//end foreach
        }//end if

        if (false === $included) {
            // There were include rules set, but this file
            // path didn't match any of them.
            return false;
        }

        ++$messageCount;
        if (true === $fixable) {
            ++$this->fixableCount;
        }

        if (false === $this->configCache['recordErrors']
            && false === $includeAll
        ) {
            return true;
        }

        // See if there is a custom error message format to use.
        // But don't do this if we are replaying errors because replayed
        // errors have already used the custom format and have had their
        // data replaced.
        if (false === $this->replayingErrors
            && true === isset($this->ruleset->ruleset[$sniffCode]['message'])
        ) {
            $message = $this->ruleset->ruleset[$sniffCode]['message'];
        }

        if (false === empty($data)) {
            $message = vsprintf($message, $data);
        }

        if (false === isset($messages[$line])) {
            $messages[$line] = [];
        }

        if (false === isset($messages[$line][$column])) {
            $messages[$line][$column] = [];
        }

        $messages[$line][$column][] = [
            'message' => $message,
            'source' => $sniffCode,
            'listener' => $this->activeListener,
            'severity' => $severity,
            'fixable' => $fixable,
        ];

        if (PHP_CODESNIFFER_VERBOSITY > 1
            && true === $this->fixer->enabled
            && true === $fixable
        ) {
            @ob_end_clean();
            echo "\tE: [Line {$line}] {$message} ({$sniffCode})" . PHP_EOL;
            ob_start();
        }

        return true;
    }

    //end addMessage()
}//end class
