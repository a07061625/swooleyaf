<?php
/**
 * Functions for helping process standards.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Util;

use PHP_CodeSniffer\Config;

class Standards
{
    /**
     * Get a list of paths where standards are installed.
     *
     * Unresolvable relative paths will be excluded from the results.
     *
     * @return array
     */
    public static function getInstalledStandardPaths()
    {
        $ds = \DIRECTORY_SEPARATOR;

        $installedPaths = [\dirname(\dirname(__DIR__)) . $ds . 'src' . $ds . 'Standards'];
        $configPaths = Config::getConfigData('installed_paths');
        if (null !== $configPaths) {
            $installedPaths = array_merge($installedPaths, explode(',', $configPaths));
        }

        $resolvedInstalledPaths = [];
        foreach ($installedPaths as $installedPath) {
            if ('.' === substr($installedPath, 0, 1)) {
                $installedPath = Common::realPath(__DIR__ . $ds . '..' . $ds . '..' . $ds . $installedPath);
                if (false === $installedPath) {
                    continue;
                }
            }

            $resolvedInstalledPaths[] = $installedPath;
        }

        return $resolvedInstalledPaths;
    }

    //end getInstalledStandardPaths()

    /**
     * Get the details of all coding standards installed.
     *
     * Coding standards are directories located in the
     * CodeSniffer/Standards directory. Valid coding standards
     * include a Sniffs subdirectory.
     *
     * The details returned for each standard are:
     * - path:      the path to the coding standard's main directory
     * - name:      the name of the coding standard, as sourced from the ruleset.xml file
     * - namespace: the namespace used by the coding standard, as sourced from the ruleset.xml file
     *
     * If you only need the paths to the installed standards,
     * use getInstalledStandardPaths() instead as it performs less work to
     * retrieve coding standard names.
     *
     * @param bool   $includeGeneric If true, the special "Generic"
     *                               coding standard will be included
     *                               if installed.
     * @param string $standardsDir   A specific directory to look for standards
     *                               in. If not specified, PHP_CodeSniffer will
     *                               look in its default locations.
     *
     * @return array
     *
     * @see    getInstalledStandardPaths()
     */
    public static function getInstalledStandardDetails(
        $includeGeneric = false,
        $standardsDir = ''
    ) {
        $rulesets = [];

        if ('' === $standardsDir) {
            $installedPaths = self::getInstalledStandardPaths();
        } else {
            $installedPaths = [$standardsDir];
        }

        foreach ($installedPaths as $standardsDir) {
            // Check if the installed dir is actually a standard itself.
            $csFile = $standardsDir . '/ruleset.xml';
            if (true === is_file($csFile)) {
                $rulesets[] = $csFile;

                continue;
            }

            if (false === is_dir($standardsDir)) {
                continue;
            }

            $di = new \DirectoryIterator($standardsDir);
            foreach ($di as $file) {
                if (true === $file->isDir() && false === $file->isDot()) {
                    $filename = $file->getFilename();

                    // Ignore the special "Generic" standard.
                    if (false === $includeGeneric && 'Generic' === $filename) {
                        continue;
                    }

                    // Valid coding standard dirs include a ruleset.
                    $csFile = $file->getPathname() . '/ruleset.xml';
                    if (true === is_file($csFile)) {
                        $rulesets[] = $csFile;
                    }
                }
            }
        }//end foreach

        $installedStandards = [];

        foreach ($rulesets as $rulesetPath) {
            $ruleset = @simplexml_load_string(file_get_contents($rulesetPath));
            if (false === $ruleset) {
                continue;
            }

            $standardName = (string)$ruleset['name'];
            $dirname = basename(\dirname($rulesetPath));

            if (true === isset($ruleset['namespace'])) {
                $namespace = (string)$ruleset['namespace'];
            } else {
                $namespace = $dirname;
            }

            $installedStandards[$dirname] = [
                'path' => \dirname($rulesetPath),
                'name' => $standardName,
                'namespace' => $namespace,
            ];
        }//end foreach

        return $installedStandards;
    }

    //end getInstalledStandardDetails()

    /**
     * Get a list of all coding standards installed.
     *
     * Coding standards are directories located in the
     * CodeSniffer/Standards directory. Valid coding standards
     * include a Sniffs subdirectory.
     *
     * @param bool   $includeGeneric If true, the special "Generic"
     *                               coding standard will be included
     *                               if installed.
     * @param string $standardsDir   A specific directory to look for standards
     *                               in. If not specified, PHP_CodeSniffer will
     *                               look in its default locations.
     *
     * @return array
     *
     * @see    isInstalledStandard()
     */
    public static function getInstalledStandards(
        $includeGeneric = false,
        $standardsDir = ''
    ) {
        $installedStandards = [];

        if ('' === $standardsDir) {
            $installedPaths = self::getInstalledStandardPaths();
        } else {
            $installedPaths = [$standardsDir];
        }

        foreach ($installedPaths as $standardsDir) {
            // Check if the installed dir is actually a standard itself.
            $csFile = $standardsDir . '/ruleset.xml';
            if (true === is_file($csFile)) {
                $installedStandards[] = basename($standardsDir);

                continue;
            }

            if (false === is_dir($standardsDir)) {
                // Doesn't exist.
                continue;
            }

            $di = new \DirectoryIterator($standardsDir);
            foreach ($di as $file) {
                if (true === $file->isDir() && false === $file->isDot()) {
                    $filename = $file->getFilename();

                    // Ignore the special "Generic" standard.
                    if (false === $includeGeneric && 'Generic' === $filename) {
                        continue;
                    }

                    // Valid coding standard dirs include a ruleset.
                    $csFile = $file->getPathname() . '/ruleset.xml';
                    if (true === is_file($csFile)) {
                        $installedStandards[] = $filename;
                    }
                }
            }
        }//end foreach

        return $installedStandards;
    }

    //end getInstalledStandards()

    /**
     * Determine if a standard is installed.
     *
     * Coding standards are directories located in the
     * CodeSniffer/Standards directory. Valid coding standards
     * include a ruleset.xml file.
     *
     * @param string $standard The name of the coding standard.
     *
     * @return bool
     *
     * @see    getInstalledStandards()
     */
    public static function isInstalledStandard($standard)
    {
        $path = self::getInstalledStandardPath($standard);
        if (null !== $path && false !== strpos($path, 'ruleset.xml')) {
            return true;
        }
        // This could be a custom standard, installed outside our
        // standards directory.
        $standard = Common::realPath($standard);
        if (false === $standard) {
            return false;
        }

        // Might be an actual ruleset file itUtil.
        // If it has an XML extension, let's at least try it.
        if (true === is_file($standard)
                && ('.xml' === substr(strtolower($standard), -4)
                || '.xml.dist' === substr(strtolower($standard), -9))
            ) {
            return true;
        }

        // If it is a directory with a ruleset.xml file in it,
        // it is a standard.
        $ruleset = rtrim($standard, ' /\\') . \DIRECTORY_SEPARATOR . 'ruleset.xml';
        if (true === is_file($ruleset)) {
            return true;
        }
        //end if

        return false;
    }

    //end isInstalledStandard()

    /**
     * Return the path of an installed coding standard.
     *
     * Coding standards are directories located in the
     * CodeSniffer/Standards directory. Valid coding standards
     * include a ruleset.xml file.
     *
     * @param string $standard The name of the coding standard.
     *
     * @return null|string
     */
    public static function getInstalledStandardPath($standard)
    {
        if (false !== strpos($standard, '.')) {
            return;
        }

        $installedPaths = self::getInstalledStandardPaths();
        foreach ($installedPaths as $installedPath) {
            $standardPath = $installedPath . \DIRECTORY_SEPARATOR . $standard;
            if (false === file_exists($standardPath)) {
                if (basename($installedPath) !== $standard) {
                    continue;
                }

                $standardPath = $installedPath;
            }

            $path = Common::realpath($standardPath . \DIRECTORY_SEPARATOR . 'ruleset.xml');

            if (false !== $path && true === is_file($path)) {
                return $path;
            }
            if (true === Common::isPharFile($standardPath)) {
                $path = Common::realpath($standardPath);
                if (false !== $path) {
                    return $path;
                }
            }
        }//end foreach
    }

    //end getInstalledStandardPath()

    /**
     * Prints out a list of installed coding standards.
     */
    public static function printInstalledStandards()
    {
        $installedStandards = self::getInstalledStandards();
        $numStandards = \count($installedStandards);

        if (0 === $numStandards) {
            echo 'No coding standards are installed.' . PHP_EOL;
        } else {
            $lastStandard = array_pop($installedStandards);
            if (1 === $numStandards) {
                echo "The only coding standard installed is {$lastStandard}" . PHP_EOL;
            } else {
                $standardList = implode(', ', $installedStandards);
                $standardList .= ' and ' . $lastStandard;
                echo 'The installed coding standards are ' . $standardList . PHP_EOL;
            }
        }
    }

    //end printInstalledStandards()
}//end class
