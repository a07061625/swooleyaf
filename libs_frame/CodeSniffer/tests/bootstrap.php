<?php
/**
 * Bootstrap file for PHP_CodeSniffer unit tests.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2017 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */
if (false === defined('PHP_CODESNIFFER_IN_TESTS')) {
    define('PHP_CODESNIFFER_IN_TESTS', true);
}

if (false === defined('PHP_CODESNIFFER_CBF')) {
    define('PHP_CODESNIFFER_CBF', false);
}

if (false === defined('PHP_CODESNIFFER_VERBOSITY')) {
    define('PHP_CODESNIFFER_VERBOSITY', 0);
}

if (true === is_file(__DIR__ . '/../autoload.php')) {
    include_once __DIR__ . '/../autoload.php';
} else {
    include_once 'PHP/CodeSniffer/autoload.php';
}

$tokens = new \PHP_CodeSniffer\Util\Tokens();

// Compatibility for PHPUnit < 6 and PHPUnit 6+.
if (true === class_exists('PHPUnit_Framework_TestSuite') && false === class_exists('PHPUnit\Framework\TestSuite')) {
    class_alias('PHPUnit_Framework_TestSuite', 'PHPUnit' . '\Framework\TestSuite');
}

if (true === class_exists('PHPUnit_Framework_TestCase') && false === class_exists('PHPUnit\Framework\TestCase')) {
    class_alias('PHPUnit_Framework_TestCase', 'PHPUnit' . '\Framework\TestCase');
}

if (true === class_exists('PHPUnit_TextUI_TestRunner') && false === class_exists('PHPUnit\TextUI\TestRunner')) {
    class_alias('PHPUnit_TextUI_TestRunner', 'PHPUnit' . '\TextUI\TestRunner');
}

if (true === class_exists('PHPUnit_Framework_TestResult') && false === class_exists('PHPUnit\Framework\TestResult')) {
    class_alias('PHPUnit_Framework_TestResult', 'PHPUnit' . '\Framework\TestResult');
}

// Determine whether this is a PEAR install or not.
$GLOBALS['PHP_CODESNIFFER_PEAR'] = false;

if (false === is_file(__DIR__ . '/../autoload.php')) {
    $GLOBALS['PHP_CODESNIFFER_PEAR'] = true;
}

/**
 * A global util function to help print unit test fixing data.
 */
function printPHPCodeSnifferTestOutput()
{
    echo PHP_EOL . PHP_EOL;

    $output = 'The test files';
    $data = [];

    $codeCount = count($GLOBALS['PHP_CODESNIFFER_SNIFF_CODES']);
    if (false === empty($GLOBALS['PHP_CODESNIFFER_SNIFF_CASE_FILES'])) {
        $files = call_user_func_array('array_merge', $GLOBALS['PHP_CODESNIFFER_SNIFF_CASE_FILES']);
        $files = array_unique($files);
        $fileCount = count($files);

        $output = '%d sniff test files';
        $data[] = $fileCount;
    }

    $output .= ' generated %d unique error codes';
    $data[] = $codeCount;

    if ($codeCount > 0) {
        $fixes = count($GLOBALS['PHP_CODESNIFFER_FIXABLE_CODES']);
        $percent = round(($fixes / $codeCount * 100), 2);

        $output .= '; %d were fixable (%d%%)';
        $data[] = $fixes;
        $data[] = $percent;
    }

    vprintf($output, $data);
}//end printPHPCodeSnifferTestOutput()
