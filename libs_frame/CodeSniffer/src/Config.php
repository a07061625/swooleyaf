<?php
/**
 * Stores the configuration used to run PHPCS and PHPCBF.
 *
 * Parses the command line to determine user supplied values
 * and provides functions to access data stored in config files.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer;

use PHP_CodeSniffer\Exceptions\DeepExitException;
use PHP_CodeSniffer\Exceptions\RuntimeException;

/**
 * Stores the configuration used to run PHPCS and PHPCBF.
 *
 * @property string[] $files           The files and directories to check.
 * @property string[] $standards       The standards being used for checking.
 * @property int      $verbosity       How verbose the output should be.
 *                                     0: no unnecessary output
 *                                     1: basic output for files being checked
 *                                     2: ruleset and file parsing output
 *                                     3: sniff execution output
 * @property bool     $interactive     Enable interactive checking mode.
 * @property bool     $parallel        Check files in parallel.
 * @property bool     $cache           Enable the use of the file cache.
 * @property bool     $cacheFile       A file where the cache data should be written
 * @property bool     $colors          Display colours in output.
 * @property bool     $explain         Explain the coding standards.
 * @property bool     $local           Process local files in directories only (no recursion).
 * @property bool     $showSources     Show sniff source codes in report output.
 * @property bool     $showProgress    Show basic progress information while running.
 * @property bool     $quiet           Quiet mode; disables progress and verbose output.
 * @property bool     $annotations     Process phpcs: annotations.
 * @property int      $tabWidth        How many spaces each tab is worth.
 * @property string   $encoding        The encoding of the files being checked.
 * @property string[] $sniffs          The sniffs that should be used for checking.
 *                                     If empty, all sniffs in the supplied standards will be used.
 * @property string[] $exclude         The sniffs that should be excluded from checking.
 *                                     If empty, all sniffs in the supplied standards will be used.
 * @property string[] $ignored         Regular expressions used to ignore files and folders during checking.
 * @property string   $reportFile      A file where the report output should be written.
 * @property string   $generator       The documentation generator to use.
 * @property string   $filter          The filter to use for the run.
 * @property string[] $bootstrap       One of more files to include before the run begins.
 * @property int      $reportWidth     The maximum number of columns that reports should use for output.
 *                                     Set to "auto" for have this value changed to the width of the terminal.
 * @property int      $errorSeverity   The minimum severity an error must have to be displayed.
 * @property int      $warningSeverity The minimum severity a warning must have to be displayed.
 * @property bool     $recordErrors    Record the content of error messages as well as error counts.
 * @property string   $suffix          A suffix to add to fixed files.
 * @property string   $basepath        A file system location to strip from the paths of files shown in reports.
 * @property bool     $stdin           Read content from STDIN instead of supplied files.
 * @property string   $stdinContent    Content passed directly to PHPCS on STDIN.
 * @property string   $stdinPath       The path to use for content passed on STDIN.
 * @property array<string, string>      $extensions File extensions that should be checked, and what tokenizer to use.
 *                                                  E.g., array('inc' => 'PHP');
 * @property array<string, null|string> $reports    The reports to use for printing output after the run.
 *                                                  The format of the array is:
 *                                                      array(
 *                                                          'reportName1' => 'outputFile',
 *                                                          'reportName2' => null,
 *                                                      );
 *                                                  If the array value is NULL, the report will be written to the screen.
 * @property string[] $unknown Any arguments gathered on the command line that are unknown to us.
 *                             E.g., using `phpcs -c` will give array('c');
 */
class Config
{
    /**
     * The current version.
     *
     * @var string
     */
    const VERSION = '3.6.0';

    /**
     * Package stability; either stable, beta or alpha.
     *
     * @var string
     */
    const STABILITY = 'stable';

    /**
     * Whether or not to kill the process when an unknown command line arg is found.
     *
     * If FALSE, arguments that are not command line options or file/directory paths
     * will be ignored and execution will continue. These values will be stored in
     * $this->unknown.
     *
     * @var bool
     */
    public $dieOnUnknownArg;

    /**
     * An array of settings that PHPCS and PHPCBF accept.
     *
     * This array is not meant to be accessed directly. Instead, use the settings
     * as if they are class member vars so the __get() and __set() magic methods
     * can be used to validate the values. For example, to set the verbosity level to
     * level 2, use $this->verbosity = 2; instead of accessing this property directly.
     *
     * Each of these settings is described in the class comment property list.
     *
     * @var array<string, mixed>
     */
    private $settings = [
        'files' => null,
        'standards' => null,
        'verbosity' => null,
        'interactive' => null,
        'parallel' => null,
        'cache' => null,
        'cacheFile' => null,
        'colors' => null,
        'explain' => null,
        'local' => null,
        'showSources' => null,
        'showProgress' => null,
        'quiet' => null,
        'annotations' => null,
        'tabWidth' => null,
        'encoding' => null,
        'extensions' => null,
        'sniffs' => null,
        'exclude' => null,
        'ignored' => null,
        'reportFile' => null,
        'generator' => null,
        'filter' => null,
        'bootstrap' => null,
        'reports' => null,
        'basepath' => null,
        'reportWidth' => null,
        'errorSeverity' => null,
        'warningSeverity' => null,
        'recordErrors' => null,
        'suffix' => null,
        'stdin' => null,
        'stdinContent' => null,
        'stdinPath' => null,
        'unknown' => null,
    ];

    /**
     * The current command line arguments we are processing.
     *
     * @var string[]
     */
    private $cliArgs = [];

    /**
     * Command line values that the user has supplied directly.
     *
     * @var array<string, TRUE>
     */
    private static $overriddenDefaults = [];

    /**
     * Config file data that has been loaded for the run.
     *
     * @var array<string, string>
     */
    private static $configData = null;

    /**
     * The full path to the config data file that has been loaded.
     *
     * @var string
     */
    private static $configDataFile = null;

    /**
     * Automatically discovered executable utility paths.
     *
     * @var array<string, string>
     */
    private static $executablePaths = [];

    /**
     * Creates a Config object and populates it with command line values.
     *
     * @param array $cliArgs         An array of values gathered from CLI args.
     * @param bool  $dieOnUnknownArg Whether or not to kill the process when an
     *                               unknown command line arg is found.
     */
    public function __construct(array $cliArgs = [], $dieOnUnknownArg = true)
    {
        if (true === \defined('PHP_CODESNIFFER_IN_TESTS')) {
            // Let everything through during testing so that we can
            // make use of PHPUnit command line arguments as well.
            $this->dieOnUnknownArg = false;
        } else {
            $this->dieOnUnknownArg = $dieOnUnknownArg;
        }

        if (true === empty($cliArgs)) {
            $cliArgs = $_SERVER['argv'];
            array_shift($cliArgs);
        }

        $this->restoreDefaults();
        $this->setCommandLineValues($cliArgs);

        if (false === isset(self::$overriddenDefaults['standards'])) {
            // They did not supply a standard to use.
            // Look for a default ruleset in the current directory or higher.
            $currentDir = getcwd();

            $defaultFiles = [
                '.phpcs.xml',
                'phpcs.xml',
                '.phpcs.xml.dist',
                'phpcs.xml.dist',
            ];

            do {
                foreach ($defaultFiles as $defaultFilename) {
                    $default = $currentDir . \DIRECTORY_SEPARATOR . $defaultFilename;
                    if (true === is_file($default)) {
                        $this->standards = [$default];

                        break 2;
                    }
                }

                $lastDir = $currentDir;
                $currentDir = \dirname($currentDir);
            } while ('.' !== $currentDir && $currentDir !== $lastDir && true === @is_readable($currentDir));
        }//end if

        if (false === \defined('STDIN')
            || 'WIN' === strtoupper(substr(PHP_OS, 0, 3))
        ) {
            return;
        }

        $handle = fopen('php://stdin', 'r');

        // Check for content on STDIN.
        if (true === $this->stdin
            || (false === Util\Common::isStdinATTY()
            && false === feof($handle))
        ) {
            $readStreams = [$handle];
            $writeSteams = null;

            $fileContents = '';
            while (true === \is_resource($handle) && false === feof($handle)) {
                // Set a timeout of 200ms.
                if (0 === stream_select($readStreams, $writeSteams, $writeSteams, 0, 200000)) {
                    break;
                }

                $fileContents .= fgets($handle);
            }

            if ('' !== trim($fileContents)) {
                $this->stdin = true;
                $this->stdinContent = $fileContents;
                self::$overriddenDefaults['stdin'] = true;
                self::$overriddenDefaults['stdinContent'] = true;
            }
        }//end if

        fclose($handle);
    }

    //end __construct()

    /**
     * Get the value of an inaccessible property.
     *
     * @param string $name The name of the property.
     *
     * @return mixed
     *
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException If the setting name is invalid.
     */
    public function __get($name)
    {
        if (false === \array_key_exists($name, $this->settings)) {
            throw new RuntimeException("ERROR: unable to get value of property \"{$name}\"");
        }

        return $this->settings[$name];
    }

    //end __get()

    /**
     * Set the value of an inaccessible property.
     *
     * @param string $name  The name of the property.
     * @param mixed  $value The value of the property.
     *
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException If the setting name is invalid.
     */
    public function __set($name, $value)
    {
        if (false === \array_key_exists($name, $this->settings)) {
            throw new RuntimeException("Can't __set() {$name}; setting doesn't exist");
        }

        switch ($name) {
        case 'reportWidth':
            // Support auto terminal width.
            if ('auto' === $value
                && true === \function_exists('shell_exec')
                && 1 === preg_match('|\d+ (\d+)|', shell_exec('stty size 2>&1'), $matches)
            ) {
                $value = (int)$matches[1];
            } else {
                $value = (int)$value;
            }

            break;
        case 'standards':
            $cleaned = [];

            // Check if the standard name is valid, or if the case is invalid.
            $installedStandards = Util\Standards::getInstalledStandards();
            foreach ($value as $standard) {
                foreach ($installedStandards as $validStandard) {
                    if (strtolower($standard) === strtolower($validStandard)) {
                        $standard = $validStandard;

                        break;
                    }
                }

                $cleaned[] = $standard;
            }

            $value = $cleaned;

            break;
        default:
            // No validation required.
            break;
        }//end switch

        $this->settings[$name] = $value;
    }

    //end __set()

    /**
     * Check if the value of an inaccessible property is set.
     *
     * @param string $name The name of the property.
     *
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->settings[$name]);
    }

    //end __isset()

    /**
     * Unset the value of an inaccessible property.
     *
     * @param string $name The name of the property.
     */
    public function __unset($name)
    {
        $this->settings[$name] = null;
    }

    //end __unset()

    /**
     * Get the array of all config settings.
     *
     * @return array<string, mixed>
     */
    public function getSettings()
    {
        return $this->settings;
    }

    //end getSettings()

    /**
     * Set the array of all config settings.
     *
     * @param array<string, mixed> $settings The array of config settings.
     */
    public function setSettings($settings)
    {
        return $this->settings = $settings;
    }

    //end setSettings()

    /**
     * Set the command line values.
     *
     * @param array $args An array of command line arguments to set.
     */
    public function setCommandLineValues($args)
    {
        $this->cliArgs = $args;
        $numArgs = \count($args);

        for ($i = 0; $i < $numArgs; ++$i) {
            $arg = $this->cliArgs[$i];
            if ('' === $arg) {
                continue;
            }

            if ('-' === $arg[0]) {
                if ('-' === $arg) {
                    // Asking to read from STDIN.
                    $this->stdin = true;
                    self::$overriddenDefaults['stdin'] = true;

                    continue;
                }

                if ('--' === $arg) {
                    // Empty argument, ignore it.
                    continue;
                }

                if ('-' === $arg[1]) {
                    $this->processLongArgument(substr($arg, 2), $i);
                } else {
                    $switches = str_split($arg);
                    foreach ($switches as $switch) {
                        if ('-' === $switch) {
                            continue;
                        }

                        $this->processShortArgument($switch, $i);
                    }
                }
            } else {
                $this->processUnknownArgument($arg, $i);
            }//end if
        }//end for
    }

    //end setCommandLineValues()

    /**
     * Restore default values for all possible command line arguments.
     *
     * @return array
     */
    public function restoreDefaults()
    {
        $this->files = [];
        $this->standards = ['PEAR'];
        $this->verbosity = 0;
        $this->interactive = false;
        $this->cache = false;
        $this->cacheFile = null;
        $this->colors = false;
        $this->explain = false;
        $this->local = false;
        $this->showSources = false;
        $this->showProgress = false;
        $this->quiet = false;
        $this->annotations = true;
        $this->parallel = 1;
        $this->tabWidth = 0;
        $this->encoding = 'utf-8';
        $this->extensions = [
            'php' => 'PHP',
            'inc' => 'PHP',
            'js' => 'JS',
            'css' => 'CSS',
        ];
        $this->sniffs = [];
        $this->exclude = [];
        $this->ignored = [];
        $this->reportFile = null;
        $this->generator = null;
        $this->filter = null;
        $this->bootstrap = [];
        $this->basepath = null;
        $this->reports = ['full' => null];
        $this->reportWidth = 'auto';
        $this->errorSeverity = 5;
        $this->warningSeverity = 5;
        $this->recordErrors = true;
        $this->suffix = '';
        $this->stdin = false;
        $this->stdinContent = null;
        $this->stdinPath = null;
        $this->unknown = [];

        $standard = self::getConfigData('default_standard');
        if (null !== $standard) {
            $this->standards = explode(',', $standard);
        }

        $reportFormat = self::getConfigData('report_format');
        if (null !== $reportFormat) {
            $this->reports = [$reportFormat => null];
        }

        $tabWidth = self::getConfigData('tab_width');
        if (null !== $tabWidth) {
            $this->tabWidth = (int)$tabWidth;
        }

        $encoding = self::getConfigData('encoding');
        if (null !== $encoding) {
            $this->encoding = strtolower($encoding);
        }

        $severity = self::getConfigData('severity');
        if (null !== $severity) {
            $this->errorSeverity = (int)$severity;
            $this->warningSeverity = (int)$severity;
        }

        $severity = self::getConfigData('error_severity');
        if (null !== $severity) {
            $this->errorSeverity = (int)$severity;
        }

        $severity = self::getConfigData('warning_severity');
        if (null !== $severity) {
            $this->warningSeverity = (int)$severity;
        }

        $showWarnings = self::getConfigData('show_warnings');
        if (null !== $showWarnings) {
            $showWarnings = (bool)$showWarnings;
            if (false === $showWarnings) {
                $this->warningSeverity = 0;
            }
        }

        $reportWidth = self::getConfigData('report_width');
        if (null !== $reportWidth) {
            $this->reportWidth = $reportWidth;
        }

        $showProgress = self::getConfigData('show_progress');
        if (null !== $showProgress) {
            $this->showProgress = (bool)$showProgress;
        }

        $quiet = self::getConfigData('quiet');
        if (null !== $quiet) {
            $this->quiet = (bool)$quiet;
        }

        $colors = self::getConfigData('colors');
        if (null !== $colors) {
            $this->colors = (bool)$colors;
        }

        if (false === \defined('PHP_CODESNIFFER_IN_TESTS')) {
            $cache = self::getConfigData('cache');
            if (null !== $cache) {
                $this->cache = (bool)$cache;
            }

            $parallel = self::getConfigData('parallel');
            if (null !== $parallel) {
                $this->parallel = max((int)$parallel, 1);
            }
        }
    }

    //end restoreDefaults()

    /**
     * Processes a short (-e) command line argument.
     *
     * @param string $arg The command line argument.
     * @param int    $pos The position of the argument on the command line.
     *
     * @throws \PHP_CodeSniffer\Exceptions\DeepExitException
     */
    public function processShortArgument($arg, $pos)
    {
        switch ($arg) {
        case 'h':
        case '?':
            ob_start();
            $this->printUsage();
            $output = ob_get_contents();
            ob_end_clean();

            throw new DeepExitException($output, 0);
        case 'i':
            ob_start();
            Util\Standards::printInstalledStandards();
            $output = ob_get_contents();
            ob_end_clean();

            throw new DeepExitException($output, 0);
        case 'v':
            if (true === $this->quiet) {
                // Ignore when quiet mode is enabled.
                break;
            }

            ++$this->verbosity;
            self::$overriddenDefaults['verbosity'] = true;

            break;
        case 'l':
            $this->local = true;
            self::$overriddenDefaults['local'] = true;

            break;
        case 's':
            $this->showSources = true;
            self::$overriddenDefaults['showSources'] = true;

            break;
        case 'a':
            $this->interactive = true;
            self::$overriddenDefaults['interactive'] = true;

            break;
        case 'e':
            $this->explain = true;
            self::$overriddenDefaults['explain'] = true;

            break;
        case 'p':
            if (true === $this->quiet) {
                // Ignore when quiet mode is enabled.
                break;
            }

            $this->showProgress = true;
            self::$overriddenDefaults['showProgress'] = true;

            break;
        case 'q':
            // Quiet mode disables a few other settings as well.
            $this->quiet = true;
            $this->showProgress = false;
            $this->verbosity = 0;

            self::$overriddenDefaults['quiet'] = true;

            break;
        case 'm':
            $this->recordErrors = false;
            self::$overriddenDefaults['recordErrors'] = true;

            break;
        case 'd':
            $ini = explode('=', $this->cliArgs[($pos + 1)]);
            $this->cliArgs[($pos + 1)] = '';
            if (true === isset($ini[1])) {
                ini_set($ini[0], $ini[1]);
            } else {
                ini_set($ini[0], true);
            }

            break;
        case 'n':
            if (false === isset(self::$overriddenDefaults['warningSeverity'])) {
                $this->warningSeverity = 0;
                self::$overriddenDefaults['warningSeverity'] = true;
            }

            break;
        case 'w':
            if (false === isset(self::$overriddenDefaults['warningSeverity'])) {
                $this->warningSeverity = $this->errorSeverity;
                self::$overriddenDefaults['warningSeverity'] = true;
            }

            break;
        default:
            if (false === $this->dieOnUnknownArg) {
                $unknown = $this->unknown;
                $unknown[] = $arg;
                $this->unknown = $unknown;
            } else {
                $this->processUnknownArgument('-' . $arg, $pos);
            }
        }//end switch
    }

    //end processShortArgument()

    /**
     * Processes a long (--example) command line argument.
     *
     * @param string $arg The command line argument.
     * @param int    $pos The position of the argument on the command line.
     *
     * @throws \PHP_CodeSniffer\Exceptions\DeepExitException
     */
    public function processLongArgument($arg, $pos)
    {
        switch ($arg) {
        case 'help':
            ob_start();
            $this->printUsage();
            $output = ob_get_contents();
            ob_end_clean();

            throw new DeepExitException($output, 0);
        case 'version':
            $output = 'PHP_CodeSniffer version ' . self::VERSION . ' (' . self::STABILITY . ') ';
            $output .= 'by Squiz (http://www.squiz.net)' . PHP_EOL;

            throw new DeepExitException($output, 0);
        case 'colors':
            if (true === isset(self::$overriddenDefaults['colors'])) {
                break;
            }

            $this->colors = true;
            self::$overriddenDefaults['colors'] = true;

            break;
        case 'no-colors':
            if (true === isset(self::$overriddenDefaults['colors'])) {
                break;
            }

            $this->colors = false;
            self::$overriddenDefaults['colors'] = true;

            break;
        case 'cache':
            if (true === isset(self::$overriddenDefaults['cache'])) {
                break;
            }

            if (false === \defined('PHP_CODESNIFFER_IN_TESTS')) {
                $this->cache = true;
                self::$overriddenDefaults['cache'] = true;
            }

            break;
        case 'no-cache':
            if (true === isset(self::$overriddenDefaults['cache'])) {
                break;
            }

            $this->cache = false;
            self::$overriddenDefaults['cache'] = true;

            break;
        case 'ignore-annotations':
            if (true === isset(self::$overriddenDefaults['annotations'])) {
                break;
            }

            $this->annotations = false;
            self::$overriddenDefaults['annotations'] = true;

            break;
        case 'config-set':
            if (false === isset($this->cliArgs[($pos + 1)])
                || false === isset($this->cliArgs[($pos + 2)])
            ) {
                $error = 'ERROR: Setting a config option requires a name and value' . PHP_EOL . PHP_EOL;
                $error .= $this->printShortUsage(true);

                throw new DeepExitException($error, 3);
            }

            $key = $this->cliArgs[($pos + 1)];
            $value = $this->cliArgs[($pos + 2)];
            $current = self::getConfigData($key);

            try {
                $this->setConfigData($key, $value);
            } catch (\Exception $e) {
                throw new DeepExitException($e->getMessage() . PHP_EOL, 3);
            }

            $output = 'Using config file: ' . self::$configDataFile . PHP_EOL . PHP_EOL;

            if (null === $current) {
                $output .= "Config value \"{$key}\" added successfully" . PHP_EOL;
            } else {
                $output .= "Config value \"{$key}\" updated successfully; old value was \"{$current}\"" . PHP_EOL;
            }

            throw new DeepExitException($output, 0);
        case 'config-delete':
            if (false === isset($this->cliArgs[($pos + 1)])) {
                $error = 'ERROR: Deleting a config option requires the name of the option' . PHP_EOL . PHP_EOL;
                $error .= $this->printShortUsage(true);

                throw new DeepExitException($error, 3);
            }

            $output = 'Using config file: ' . self::$configDataFile . PHP_EOL . PHP_EOL;

            $key = $this->cliArgs[($pos + 1)];
            $current = self::getConfigData($key);
            if (null === $current) {
                $output .= "Config value \"{$key}\" has not been set" . PHP_EOL;
            } else {
                try {
                    $this->setConfigData($key, null);
                } catch (\Exception $e) {
                    throw new DeepExitException($e->getMessage() . PHP_EOL, 3);
                }

                $output .= "Config value \"{$key}\" removed successfully; old value was \"{$current}\"" . PHP_EOL;
            }

            throw new DeepExitException($output, 0);
        case 'config-show':
            ob_start();
            $data = self::getAllConfigData();
            echo 'Using config file: ' . self::$configDataFile . PHP_EOL . PHP_EOL;
            $this->printConfigData($data);
            $output = ob_get_contents();
            ob_end_clean();

            throw new DeepExitException($output, 0);
        case 'runtime-set':
            if (false === isset($this->cliArgs[($pos + 1)])
                || false === isset($this->cliArgs[($pos + 2)])
            ) {
                $error = 'ERROR: Setting a runtime config option requires a name and value' . PHP_EOL . PHP_EOL;
                $error .= $this->printShortUsage(true);

                throw new DeepExitException($error, 3);
            }

            $key = $this->cliArgs[($pos + 1)];
            $value = $this->cliArgs[($pos + 2)];
            $this->cliArgs[($pos + 1)] = '';
            $this->cliArgs[($pos + 2)] = '';
            self::setConfigData($key, $value, true);
            if (false === isset(self::$overriddenDefaults['runtime-set'])) {
                self::$overriddenDefaults['runtime-set'] = [];
            }

            self::$overriddenDefaults['runtime-set'][$key] = true;

            break;
        default:
            if ('sniffs=' === substr($arg, 0, 7)) {
                if (true === isset(self::$overriddenDefaults['sniffs'])) {
                    break;
                }

                $sniffs = explode(',', substr($arg, 7));
                foreach ($sniffs as $sniff) {
                    if (2 !== substr_count($sniff, '.')) {
                        $error = 'ERROR: The specified sniff code "' . $sniff . '" is invalid' . PHP_EOL . PHP_EOL;
                        $error .= $this->printShortUsage(true);

                        throw new DeepExitException($error, 3);
                    }
                }

                $this->sniffs = $sniffs;
                self::$overriddenDefaults['sniffs'] = true;
            } elseif ('exclude=' === substr($arg, 0, 8)) {
                if (true === isset(self::$overriddenDefaults['exclude'])) {
                    break;
                }

                $sniffs = explode(',', substr($arg, 8));
                foreach ($sniffs as $sniff) {
                    if (2 !== substr_count($sniff, '.')) {
                        $error = 'ERROR: The specified sniff code "' . $sniff . '" is invalid' . PHP_EOL . PHP_EOL;
                        $error .= $this->printShortUsage(true);

                        throw new DeepExitException($error, 3);
                    }
                }

                $this->exclude = $sniffs;
                self::$overriddenDefaults['exclude'] = true;
            } elseif (false === \defined('PHP_CODESNIFFER_IN_TESTS')
                && 'cache=' === substr($arg, 0, 6)
            ) {
                if ((true === isset(self::$overriddenDefaults['cache'])
                    && false === $this->cache)
                    || true === isset(self::$overriddenDefaults['cacheFile'])
                ) {
                    break;
                }

                // Turn caching on.
                $this->cache = true;
                self::$overriddenDefaults['cache'] = true;

                $this->cacheFile = Util\Common::realpath(substr($arg, 6));

                // It may not exist and return false instead.
                if (false === $this->cacheFile) {
                    $this->cacheFile = substr($arg, 6);

                    $dir = \dirname($this->cacheFile);
                    if (false === is_dir($dir)) {
                        $error = 'ERROR: The specified cache file path "' . $this->cacheFile . '" points to a non-existent directory' . PHP_EOL . PHP_EOL;
                        $error .= $this->printShortUsage(true);

                        throw new DeepExitException($error, 3);
                    }

                    if ('.' === $dir) {
                        // Passed cache file is a file in the current directory.
                        $this->cacheFile = getcwd() . '/' . basename($this->cacheFile);
                    } else {
                        if ('/' === $dir[0]) {
                            // An absolute path.
                            $dir = Util\Common::realpath($dir);
                        } else {
                            $dir = Util\Common::realpath(getcwd() . '/' . $dir);
                        }

                        if (false !== $dir) {
                            // Cache file path is relative.
                            $this->cacheFile = $dir . '/' . basename($this->cacheFile);
                        }
                    }
                }//end if

                self::$overriddenDefaults['cacheFile'] = true;

                if (true === is_dir($this->cacheFile)) {
                    $error = 'ERROR: The specified cache file path "' . $this->cacheFile . '" is a directory' . PHP_EOL . PHP_EOL;
                    $error .= $this->printShortUsage(true);

                    throw new DeepExitException($error, 3);
                }
            } elseif ('bootstrap=' === substr($arg, 0, 10)) {
                $files = explode(',', substr($arg, 10));
                $bootstrap = [];
                foreach ($files as $file) {
                    $path = Util\Common::realpath($file);
                    if (false === $path) {
                        $error = 'ERROR: The specified bootstrap file "' . $file . '" does not exist' . PHP_EOL . PHP_EOL;
                        $error .= $this->printShortUsage(true);

                        throw new DeepExitException($error, 3);
                    }

                    $bootstrap[] = $path;
                }

                $this->bootstrap = array_merge($this->bootstrap, $bootstrap);
                self::$overriddenDefaults['bootstrap'] = true;
            } elseif ('file-list=' === substr($arg, 0, 10)) {
                $fileList = substr($arg, 10);
                $path = Util\Common::realpath($fileList);
                if (false === $path) {
                    $error = 'ERROR: The specified file list "' . $fileList . '" does not exist' . PHP_EOL . PHP_EOL;
                    $error .= $this->printShortUsage(true);

                    throw new DeepExitException($error, 3);
                }

                $files = file($path);
                foreach ($files as $inputFile) {
                    $inputFile = trim($inputFile);

                    // Skip empty lines.
                    if ('' === $inputFile) {
                        continue;
                    }

                    $this->processFilePath($inputFile);
                }
            } elseif ('stdin-path=' === substr($arg, 0, 11)) {
                if (true === isset(self::$overriddenDefaults['stdinPath'])) {
                    break;
                }

                $this->stdinPath = Util\Common::realpath(substr($arg, 11));

                // It may not exist and return false instead, so use whatever they gave us.
                if (false === $this->stdinPath) {
                    $this->stdinPath = trim(substr($arg, 11));
                }

                self::$overriddenDefaults['stdinPath'] = true;
            } elseif (PHP_CODESNIFFER_CBF === false && 'report-file=' === substr($arg, 0, 12)) {
                if (true === isset(self::$overriddenDefaults['reportFile'])) {
                    break;
                }

                $this->reportFile = Util\Common::realpath(substr($arg, 12));

                // It may not exist and return false instead.
                if (false === $this->reportFile) {
                    $this->reportFile = substr($arg, 12);

                    $dir = Util\Common::realpath(\dirname($this->reportFile));
                    if (false === is_dir($dir)) {
                        $error = 'ERROR: The specified report file path "' . $this->reportFile . '" points to a non-existent directory' . PHP_EOL . PHP_EOL;
                        $error .= $this->printShortUsage(true);

                        throw new DeepExitException($error, 3);
                    }

                    $this->reportFile = $dir . '/' . basename($this->reportFile);
                }//end if

                self::$overriddenDefaults['reportFile'] = true;

                if (true === is_dir($this->reportFile)) {
                    $error = 'ERROR: The specified report file path "' . $this->reportFile . '" is a directory' . PHP_EOL . PHP_EOL;
                    $error .= $this->printShortUsage(true);

                    throw new DeepExitException($error, 3);
                }
            } elseif ('report-width=' === substr($arg, 0, 13)) {
                if (true === isset(self::$overriddenDefaults['reportWidth'])) {
                    break;
                }

                $this->reportWidth = substr($arg, 13);
                self::$overriddenDefaults['reportWidth'] = true;
            } elseif ('basepath=' === substr($arg, 0, 9)) {
                if (true === isset(self::$overriddenDefaults['basepath'])) {
                    break;
                }

                self::$overriddenDefaults['basepath'] = true;

                if ('' === substr($arg, 9)) {
                    $this->basepath = null;

                    break;
                }

                $this->basepath = Util\Common::realpath(substr($arg, 9));

                // It may not exist and return false instead.
                if (false === $this->basepath) {
                    $this->basepath = substr($arg, 9);
                }

                if (false === is_dir($this->basepath)) {
                    $error = 'ERROR: The specified basepath "' . $this->basepath . '" points to a non-existent directory' . PHP_EOL . PHP_EOL;
                    $error .= $this->printShortUsage(true);

                    throw new DeepExitException($error, 3);
                }
            } elseif (('report=' === substr($arg, 0, 7) || 'report-' === substr($arg, 0, 7))) {
                $reports = [];

                if ('-' === $arg[6]) {
                    // This is a report with file output.
                    $split = strpos($arg, '=');
                    if (false === $split) {
                        $report = substr($arg, 7);
                        $output = null;
                    } else {
                        $report = substr($arg, 7, ($split - 7));
                        $output = substr($arg, ($split + 1));
                        if (false === $output) {
                            $output = null;
                        } else {
                            $dir = Util\Common::realpath(\dirname($output));
                            if (false === is_dir($dir)) {
                                $error = 'ERROR: The specified ' . $report . ' report file path "' . $output . '" points to a non-existent directory' . PHP_EOL . PHP_EOL;
                                $error .= $this->printShortUsage(true);

                                throw new DeepExitException($error, 3);
                            }

                            $output = $dir . '/' . basename($output);

                            if (true === is_dir($output)) {
                                $error = 'ERROR: The specified ' . $report . ' report file path "' . $output . '" is a directory' . PHP_EOL . PHP_EOL;
                                $error .= $this->printShortUsage(true);

                                throw new DeepExitException($error, 3);
                            }
                        }//end if
                    }//end if

                    $reports[$report] = $output;
                } else {
                    // This is a single report.
                    if (true === isset(self::$overriddenDefaults['reports'])) {
                        break;
                    }

                    $reportNames = explode(',', substr($arg, 7));
                    foreach ($reportNames as $report) {
                        $reports[$report] = null;
                    }
                }//end if

                // Remove the default value so the CLI value overrides it.
                if (false === isset(self::$overriddenDefaults['reports'])) {
                    $this->reports = $reports;
                } else {
                    $this->reports = array_merge($this->reports, $reports);
                }

                self::$overriddenDefaults['reports'] = true;
            } elseif ('filter=' === substr($arg, 0, 7)) {
                if (true === isset(self::$overriddenDefaults['filter'])) {
                    break;
                }

                $this->filter = substr($arg, 7);
                self::$overriddenDefaults['filter'] = true;
            } elseif ('standard=' === substr($arg, 0, 9)) {
                $standards = trim(substr($arg, 9));
                if ('' !== $standards) {
                    $this->standards = explode(',', $standards);
                }

                self::$overriddenDefaults['standards'] = true;
            } elseif ('extensions=' === substr($arg, 0, 11)) {
                if (true === isset(self::$overriddenDefaults['extensions'])) {
                    break;
                }

                $extensions = explode(',', substr($arg, 11));
                $newExtensions = [];
                foreach ($extensions as $ext) {
                    $slash = strpos($ext, '/');
                    if (false !== $slash) {
                        // They specified the tokenizer too.
                        list($ext, $tokenizer) = explode('/', $ext);
                        $newExtensions[$ext] = strtoupper($tokenizer);

                        continue;
                    }

                    if (true === isset($this->extensions[$ext])) {
                        $newExtensions[$ext] = $this->extensions[$ext];
                    } else {
                        $newExtensions[$ext] = 'PHP';
                    }
                }

                $this->extensions = $newExtensions;
                self::$overriddenDefaults['extensions'] = true;
            } elseif ('suffix=' === substr($arg, 0, 7)) {
                if (true === isset(self::$overriddenDefaults['suffix'])) {
                    break;
                }

                $this->suffix = substr($arg, 7);
                self::$overriddenDefaults['suffix'] = true;
            } elseif ('parallel=' === substr($arg, 0, 9)) {
                if (true === isset(self::$overriddenDefaults['parallel'])) {
                    break;
                }

                $this->parallel = max((int)substr($arg, 9), 1);
                self::$overriddenDefaults['parallel'] = true;
            } elseif ('severity=' === substr($arg, 0, 9)) {
                $this->errorSeverity = (int)substr($arg, 9);
                $this->warningSeverity = $this->errorSeverity;
                if (false === isset(self::$overriddenDefaults['errorSeverity'])) {
                    self::$overriddenDefaults['errorSeverity'] = true;
                }

                if (false === isset(self::$overriddenDefaults['warningSeverity'])) {
                    self::$overriddenDefaults['warningSeverity'] = true;
                }
            } elseif ('error-severity=' === substr($arg, 0, 15)) {
                if (true === isset(self::$overriddenDefaults['errorSeverity'])) {
                    break;
                }

                $this->errorSeverity = (int)substr($arg, 15);
                self::$overriddenDefaults['errorSeverity'] = true;
            } elseif ('warning-severity=' === substr($arg, 0, 17)) {
                if (true === isset(self::$overriddenDefaults['warningSeverity'])) {
                    break;
                }

                $this->warningSeverity = (int)substr($arg, 17);
                self::$overriddenDefaults['warningSeverity'] = true;
            } elseif ('ignore=' === substr($arg, 0, 7)) {
                if (true === isset(self::$overriddenDefaults['ignored'])) {
                    break;
                }

                // Split the ignore string on commas, unless the comma is escaped
                // using 1 or 3 slashes (\, or \\\,).
                $patterns = preg_split(
                    '/(?<=(?<!\\\\)\\\\\\\\),|(?<!\\\\),/',
                    substr($arg, 7)
                );

                $ignored = [];
                foreach ($patterns as $pattern) {
                    $pattern = trim($pattern);
                    if ('' === $pattern) {
                        continue;
                    }

                    $ignored[$pattern] = 'absolute';
                }

                $this->ignored = $ignored;
                self::$overriddenDefaults['ignored'] = true;
            } elseif ('generator=' === substr($arg, 0, 10)
                && PHP_CODESNIFFER_CBF === false
            ) {
                if (true === isset(self::$overriddenDefaults['generator'])) {
                    break;
                }

                $this->generator = substr($arg, 10);
                self::$overriddenDefaults['generator'] = true;
            } elseif ('encoding=' === substr($arg, 0, 9)) {
                if (true === isset(self::$overriddenDefaults['encoding'])) {
                    break;
                }

                $this->encoding = strtolower(substr($arg, 9));
                self::$overriddenDefaults['encoding'] = true;
            } elseif ('tab-width=' === substr($arg, 0, 10)) {
                if (true === isset(self::$overriddenDefaults['tabWidth'])) {
                    break;
                }

                $this->tabWidth = (int)substr($arg, 10);
                self::$overriddenDefaults['tabWidth'] = true;
            } else {
                if (false === $this->dieOnUnknownArg) {
                    $eqPos = strpos($arg, '=');

                    try {
                        if (false === $eqPos) {
                            $this->values[$arg] = $arg;
                        } else {
                            $value = substr($arg, ($eqPos + 1));
                            $arg = substr($arg, 0, $eqPos);
                            $this->values[$arg] = $value;
                        }
                    } catch (RuntimeException $e) {
                        // Value is not valid, so just ignore it.
                    }
                } else {
                    $this->processUnknownArgument('--' . $arg, $pos);
                }
            }//end if

            break;
        }//end switch
    }

    //end processLongArgument()

    /**
     * Processes an unknown command line argument.
     *
     * Assumes all unknown arguments are files and folders to check.
     *
     * @param string $arg The command line argument.
     * @param int    $pos The position of the argument on the command line.
     *
     * @throws \PHP_CodeSniffer\Exceptions\DeepExitException
     */
    public function processUnknownArgument($arg, $pos)
    {
        // We don't know about any additional switches; just files.
        if ('-' === $arg[0]) {
            if (false === $this->dieOnUnknownArg) {
                return;
            }

            $error = "ERROR: option \"{$arg}\" not known" . PHP_EOL . PHP_EOL;
            $error .= $this->printShortUsage(true);

            throw new DeepExitException($error, 3);
        }

        $this->processFilePath($arg);
    }

    //end processUnknownArgument()

    /**
     * Processes a file path and add it to the file list.
     *
     * @param string $path The path to the file to add.
     *
     * @throws \PHP_CodeSniffer\Exceptions\DeepExitException
     */
    public function processFilePath($path)
    {
        // If we are processing STDIN, don't record any files to check.
        if (true === $this->stdin) {
            return;
        }

        $file = Util\Common::realpath($path);
        if (false === file_exists($file)) {
            if (false === $this->dieOnUnknownArg) {
                return;
            }

            $error = 'ERROR: The file "' . $path . '" does not exist.' . PHP_EOL . PHP_EOL;
            $error .= $this->printShortUsage(true);

            throw new DeepExitException($error, 3);
        }
        // Can't modify the files array directly because it's not a real
        // class member, so need to use this little get/modify/set trick.
        $files = $this->files;
        $files[] = $file;
        $this->files = $files;
        self::$overriddenDefaults['files'] = true;
    }

    //end processFilePath()

    /**
     * Prints out the usage information for this script.
     */
    public function printUsage()
    {
        echo PHP_EOL;

        if (PHP_CODESNIFFER_CBF === true) {
            $this->printPHPCBFUsage();
        } else {
            $this->printPHPCSUsage();
        }

        echo PHP_EOL;
    }

    //end printUsage()

    /**
     * Prints out the short usage information for this script.
     *
     * @param bool $return If TRUE, the usage string is returned
     *                     instead of output to screen.
     *
     * @return string|void
     */
    public function printShortUsage($return = false)
    {
        if (PHP_CODESNIFFER_CBF === true) {
            $usage = 'Run "phpcbf --help" for usage information';
        } else {
            $usage = 'Run "phpcs --help" for usage information';
        }

        $usage .= PHP_EOL . PHP_EOL;

        if (true === $return) {
            return $usage;
        }

        echo $usage;
    }

    //end printShortUsage()

    /**
     * Prints out the usage information for PHPCS.
     */
    public function printPHPCSUsage()
    {
        echo 'Usage: phpcs [-nwlsaepqvi] [-d key[=value]] [--colors] [--no-colors]' . PHP_EOL;
        echo '  [--cache[=<cacheFile>]] [--no-cache] [--tab-width=<tabWidth>]' . PHP_EOL;
        echo '  [--report=<report>] [--report-file=<reportFile>] [--report-<report>=<reportFile>]' . PHP_EOL;
        echo '  [--report-width=<reportWidth>] [--basepath=<basepath>] [--bootstrap=<bootstrap>]' . PHP_EOL;
        echo '  [--severity=<severity>] [--error-severity=<severity>] [--warning-severity=<severity>]' . PHP_EOL;
        echo '  [--runtime-set key value] [--config-set key value] [--config-delete key] [--config-show]' . PHP_EOL;
        echo '  [--standard=<standard>] [--sniffs=<sniffs>] [--exclude=<sniffs>]' . PHP_EOL;
        echo '  [--encoding=<encoding>] [--parallel=<processes>] [--generator=<generator>]' . PHP_EOL;
        echo '  [--extensions=<extensions>] [--ignore=<patterns>] [--ignore-annotations]' . PHP_EOL;
        echo '  [--stdin-path=<stdinPath>] [--file-list=<fileList>] [--filter=<filter>] <file> - ...' . PHP_EOL;
        echo PHP_EOL;
        echo ' -     Check STDIN instead of local files and directories' . PHP_EOL;
        echo ' -n    Do not print warnings (shortcut for --warning-severity=0)' . PHP_EOL;
        echo ' -w    Print both warnings and errors (this is the default)' . PHP_EOL;
        echo ' -l    Local directory only, no recursion' . PHP_EOL;
        echo ' -s    Show sniff codes in all reports' . PHP_EOL;
        echo ' -a    Run interactively' . PHP_EOL;
        echo ' -e    Explain a standard by showing the sniffs it includes' . PHP_EOL;
        echo ' -p    Show progress of the run' . PHP_EOL;
        echo ' -q    Quiet mode; disables progress and verbose output' . PHP_EOL;
        echo ' -m    Stop error messages from being recorded' . PHP_EOL;
        echo '       (saves a lot of memory, but stops many reports from being used)' . PHP_EOL;
        echo ' -v    Print processed files' . PHP_EOL;
        echo ' -vv   Print ruleset and token output' . PHP_EOL;
        echo ' -vvv  Print sniff processing information' . PHP_EOL;
        echo ' -i    Show a list of installed coding standards' . PHP_EOL;
        echo ' -d    Set the [key] php.ini value to [value] or [true] if value is omitted' . PHP_EOL;
        echo PHP_EOL;
        echo ' --help                Print this help message' . PHP_EOL;
        echo ' --version             Print version information' . PHP_EOL;
        echo ' --colors              Use colors in output' . PHP_EOL;
        echo ' --no-colors           Do not use colors in output (this is the default)' . PHP_EOL;
        echo ' --cache               Cache results between runs' . PHP_EOL;
        echo ' --no-cache            Do not cache results between runs (this is the default)' . PHP_EOL;
        echo ' --ignore-annotations  Ignore all phpcs: annotations in code comments' . PHP_EOL;
        echo PHP_EOL;
        echo ' <cacheFile>    Use a specific file for caching (uses a temporary file by default)' . PHP_EOL;
        echo ' <basepath>     A path to strip from the front of file paths inside reports' . PHP_EOL;
        echo ' <bootstrap>    A comma separated list of files to run before processing begins' . PHP_EOL;
        echo ' <encoding>     The encoding of the files being checked (default is utf-8)' . PHP_EOL;
        echo ' <extensions>   A comma separated list of file extensions to check' . PHP_EOL;
        echo '                The type of the file can be specified using: ext/type' . PHP_EOL;
        echo '                e.g., module/php,es/js' . PHP_EOL;
        echo ' <file>         One or more files and/or directories to check' . PHP_EOL;
        echo ' <fileList>     A file containing a list of files and/or directories to check (one per line)' . PHP_EOL;
        echo ' <filter>       Use either the "gitmodified" or "gitstaged" filter,' . PHP_EOL;
        echo '                or specify the path to a custom filter class' . PHP_EOL;
        echo ' <generator>    Use either the "HTML", "Markdown" or "Text" generator' . PHP_EOL;
        echo '                (forces documentation generation instead of checking)' . PHP_EOL;
        echo ' <patterns>     A comma separated list of patterns to ignore files and directories' . PHP_EOL;
        echo ' <processes>    How many files should be checked simultaneously (default is 1)' . PHP_EOL;
        echo ' <report>       Print either the "full", "xml", "checkstyle", "csv"' . PHP_EOL;
        echo '                "json", "junit", "emacs", "source", "summary", "diff"' . PHP_EOL;
        echo '                "svnblame", "gitblame", "hgblame" or "notifysend" report,' . PHP_EOL;
        echo '                or specify the path to a custom report class' . PHP_EOL;
        echo '                (the "full" report is printed by default)' . PHP_EOL;
        echo ' <reportFile>   Write the report to the specified file path' . PHP_EOL;
        echo ' <reportWidth>  How many columns wide screen reports should be printed' . PHP_EOL;
        echo '                or set to "auto" to use current screen width, where supported' . PHP_EOL;
        echo ' <severity>     The minimum severity required to display an error or warning' . PHP_EOL;
        echo ' <sniffs>       A comma separated list of sniff codes to include or exclude from checking' . PHP_EOL;
        echo '                (all sniffs must be part of the specified standard)' . PHP_EOL;
        echo ' <standard>     The name or path of the coding standard to use' . PHP_EOL;
        echo ' <stdinPath>    If processing STDIN, the file path that STDIN will be processed as' . PHP_EOL;
        echo ' <tabWidth>     The number of spaces each tab represents' . PHP_EOL;
    }

    //end printPHPCSUsage()

    /**
     * Prints out the usage information for PHPCBF.
     */
    public function printPHPCBFUsage()
    {
        echo 'Usage: phpcbf [-nwli] [-d key[=value]] [--ignore-annotations] [--bootstrap=<bootstrap>]' . PHP_EOL;
        echo '  [--standard=<standard>] [--sniffs=<sniffs>] [--exclude=<sniffs>] [--suffix=<suffix>]' . PHP_EOL;
        echo '  [--severity=<severity>] [--error-severity=<severity>] [--warning-severity=<severity>]' . PHP_EOL;
        echo '  [--tab-width=<tabWidth>] [--encoding=<encoding>] [--parallel=<processes>]' . PHP_EOL;
        echo '  [--basepath=<basepath>] [--extensions=<extensions>] [--ignore=<patterns>]' . PHP_EOL;
        echo '  [--stdin-path=<stdinPath>] [--file-list=<fileList>] [--filter=<filter>] <file> - ...' . PHP_EOL;
        echo PHP_EOL;
        echo ' -     Fix STDIN instead of local files and directories' . PHP_EOL;
        echo ' -n    Do not fix warnings (shortcut for --warning-severity=0)' . PHP_EOL;
        echo ' -w    Fix both warnings and errors (on by default)' . PHP_EOL;
        echo ' -l    Local directory only, no recursion' . PHP_EOL;
        echo ' -p    Show progress of the run' . PHP_EOL;
        echo ' -q    Quiet mode; disables progress and verbose output' . PHP_EOL;
        echo ' -v    Print processed files' . PHP_EOL;
        echo ' -vv   Print ruleset and token output' . PHP_EOL;
        echo ' -vvv  Print sniff processing information' . PHP_EOL;
        echo ' -i    Show a list of installed coding standards' . PHP_EOL;
        echo ' -d    Set the [key] php.ini value to [value] or [true] if value is omitted' . PHP_EOL;
        echo PHP_EOL;
        echo ' --help                Print this help message' . PHP_EOL;
        echo ' --version             Print version information' . PHP_EOL;
        echo ' --ignore-annotations  Ignore all phpcs: annotations in code comments' . PHP_EOL;
        echo PHP_EOL;
        echo ' <basepath>    A path to strip from the front of file paths inside reports' . PHP_EOL;
        echo ' <bootstrap>   A comma separated list of files to run before processing begins' . PHP_EOL;
        echo ' <encoding>    The encoding of the files being fixed (default is utf-8)' . PHP_EOL;
        echo ' <extensions>  A comma separated list of file extensions to fix' . PHP_EOL;
        echo '               The type of the file can be specified using: ext/type' . PHP_EOL;
        echo '               e.g., module/php,es/js' . PHP_EOL;
        echo ' <file>        One or more files and/or directories to fix' . PHP_EOL;
        echo ' <fileList>    A file containing a list of files and/or directories to fix (one per line)' . PHP_EOL;
        echo ' <filter>      Use either the "gitmodified" or "gitstaged" filter,' . PHP_EOL;
        echo '               or specify the path to a custom filter class' . PHP_EOL;
        echo ' <patterns>    A comma separated list of patterns to ignore files and directories' . PHP_EOL;
        echo ' <processes>   How many files should be fixed simultaneously (default is 1)' . PHP_EOL;
        echo ' <severity>    The minimum severity required to fix an error or warning' . PHP_EOL;
        echo ' <sniffs>      A comma separated list of sniff codes to include or exclude from fixing' . PHP_EOL;
        echo '               (all sniffs must be part of the specified standard)' . PHP_EOL;
        echo ' <standard>    The name or path of the coding standard to use' . PHP_EOL;
        echo ' <stdinPath>   If processing STDIN, the file path that STDIN will be processed as' . PHP_EOL;
        echo ' <suffix>      Write modified files to a filename using this suffix' . PHP_EOL;
        echo '               ("diff" and "patch" are not used in this mode)' . PHP_EOL;
        echo ' <tabWidth>    The number of spaces each tab represents' . PHP_EOL;
    }

    //end printPHPCBFUsage()

    /**
     * Get a single config value.
     *
     * @param string $key The name of the config value.
     *
     * @return null|string
     *
     * @see    setConfigData()
     * @see    getAllConfigData()
     */
    public static function getConfigData($key)
    {
        $phpCodeSnifferConfig = self::getAllConfigData();

        if (null === $phpCodeSnifferConfig) {
            return;
        }

        if (false === isset($phpCodeSnifferConfig[$key])) {
            return;
        }

        return $phpCodeSnifferConfig[$key];
    }

    //end getConfigData()

    /**
     * Get the path to an executable utility.
     *
     * @param string $name The name of the executable utility.
     *
     * @return null|string
     *
     * @see    getConfigData()
     */
    public static function getExecutablePath($name)
    {
        $data = self::getConfigData($name . '_path');
        if (null !== $data) {
            return $data;
        }

        if ('php' === $name) {
            // For php, we know the executable path. There's no need to look it up.
            return PHP_BINARY;
        }

        if (true === \array_key_exists($name, self::$executablePaths)) {
            return self::$executablePaths[$name];
        }

        if ('WIN' === strtoupper(substr(PHP_OS, 0, 3))) {
            $cmd = 'where ' . escapeshellarg($name) . ' 2> nul';
        } else {
            $cmd = 'which ' . escapeshellarg($name) . ' 2> /dev/null';
        }

        $result = exec($cmd, $output, $retVal);
        if (0 !== $retVal) {
            $result = null;
        }

        self::$executablePaths[$name] = $result;

        return $result;
    }

    //end getExecutablePath()

    /**
     * Set a single config value.
     *
     * @param string      $key   The name of the config value.
     * @param null|string $value The value to set. If null, the config
     *                           entry is deleted, reverting it to the
     *                           default value.
     * @param bool        $temp  Set this config data temporarily for this
     *                           script run. This will not write the config
     *                           data to the config file.
     *
     * @return bool
     *
     * @see    getConfigData()
     *
     * @throws \PHP_CodeSniffer\Exceptions\DeepExitException If the config file can not be written.
     */
    public static function setConfigData($key, $value, $temp = false)
    {
        if (true === isset(self::$overriddenDefaults['runtime-set'])
            && true === isset(self::$overriddenDefaults['runtime-set'][$key])
        ) {
            return false;
        }

        if (false === $temp) {
            $path = '';
            if (true === \is_callable('\Phar::running')) {
                $path = \Phar::running(false);
            }

            if ('' !== $path) {
                $configFile = \dirname($path) . \DIRECTORY_SEPARATOR . 'CodeSniffer.conf';
            } else {
                $configFile = \dirname(__DIR__) . \DIRECTORY_SEPARATOR . 'CodeSniffer.conf';
                if (false === is_file($configFile)
                    && false === strpos('@data_dir@', '@data_dir')
                ) {
                    // If data_dir was replaced, this is a PEAR install and we can
                    // use the PEAR data dir to store the conf file.
                    $configFile = '@data_dir@/PHP_CodeSniffer/CodeSniffer.conf';
                }
            }

            if (true === is_file($configFile)
                && false === is_writable($configFile)
            ) {
                $error = 'ERROR: Config file ' . $configFile . ' is not writable' . PHP_EOL . PHP_EOL;

                throw new DeepExitException($error, 3);
            }
        }//end if

        $phpCodeSnifferConfig = self::getAllConfigData();

        if (null === $value) {
            if (true === isset($phpCodeSnifferConfig[$key])) {
                unset($phpCodeSnifferConfig[$key]);
            }
        } else {
            $phpCodeSnifferConfig[$key] = $value;
        }

        if (false === $temp) {
            $output = '<' . '?php' . "\n" . ' $phpCodeSnifferConfig = ';
            $output .= var_export($phpCodeSnifferConfig, true);
            $output .= "\n?" . '>';

            if (false === file_put_contents($configFile, $output)) {
                $error = 'ERROR: Config file ' . $configFile . ' could not be written' . PHP_EOL . PHP_EOL;

                throw new DeepExitException($error, 3);
            }

            self::$configDataFile = $configFile;
        }

        self::$configData = $phpCodeSnifferConfig;

        // If the installed paths are being set, make sure all known
        // standards paths are added to the autoloader.
        if ('installed_paths' === $key) {
            $installedStandards = Util\Standards::getInstalledStandardDetails();
            foreach ($installedStandards as $name => $details) {
                Autoload::addSearchPath($details['path'], $details['namespace']);
            }
        }

        return true;
    }

    //end setConfigData()

    /**
     * Get all config data.
     *
     * @return array<string, string>
     *
     * @see    getConfigData()
     *
     * @throws \PHP_CodeSniffer\Exceptions\DeepExitException If the config file could not be read.
     */
    public static function getAllConfigData()
    {
        if (null !== self::$configData) {
            return self::$configData;
        }

        $path = '';
        if (true === \is_callable('\Phar::running')) {
            $path = \Phar::running(false);
        }

        if ('' !== $path) {
            $configFile = \dirname($path) . \DIRECTORY_SEPARATOR . 'CodeSniffer.conf';
        } else {
            $configFile = \dirname(__DIR__) . \DIRECTORY_SEPARATOR . 'CodeSniffer.conf';
            if (false === is_file($configFile)
                && false === strpos('@data_dir@', '@data_dir')
            ) {
                $configFile = '@data_dir@/PHP_CodeSniffer/CodeSniffer.conf';
            }
        }

        if (false === is_file($configFile)) {
            self::$configData = [];

            return [];
        }

        if (false === is_readable($configFile)) {
            $error = 'ERROR: Config file ' . $configFile . ' is not readable' . PHP_EOL . PHP_EOL;

            throw new DeepExitException($error, 3);
        }

        include $configFile;
        self::$configDataFile = $configFile;
        self::$configData = $phpCodeSnifferConfig;

        return self::$configData;
    }

    //end getAllConfigData()

    /**
     * Prints out the gathered config data.
     *
     * @param array $data The config data to print.
     */
    public function printConfigData($data)
    {
        $max = 0;
        $keys = array_keys($data);
        foreach ($keys as $key) {
            $len = \strlen($key);
            if (\strlen($key) > $max) {
                $max = $len;
            }
        }

        if (0 === $max) {
            return;
        }

        $max += 2;
        ksort($data);
        foreach ($data as $name => $value) {
            echo str_pad($name . ': ', $max) . $value . PHP_EOL;
        }
    }

    //end printConfigData()
}//end class
