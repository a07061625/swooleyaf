<?php
/**
 * Runs the Zend Code Analyzer (from Zend Studio) on the file.
 *
 * @author    Holger Kral <holger.kral@zend.com>
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Zend\Sniffs\Debug;

use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Exceptions\RuntimeException;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class CodeAnalyzerSniff implements Sniff
{
    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return int[]
     */
    public function register()
    {
        return [T_OPEN_TAG];
    }

    //end register()

    /**
     * Processes the tokens that this sniff is interested in.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file where the token was found.
     * @param int                         $stackPtr  The position in the stack where
     *                                               the token was found.
     *
     * @return int
     *
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException If ZendCodeAnalyzer could not be run.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $analyzerPath = Config::getExecutablePath('zend_ca');
        if (null === $analyzerPath) {
            return;
        }

        $fileName = $phpcsFile->getFilename();

        // In the command, 2>&1 is important because the code analyzer sends its
        // findings to stderr. $output normally contains only stdout, so using 2>&1
        // will pipe even stderr to stdout.
        $cmd = escapeshellcmd($analyzerPath) . ' ' . escapeshellarg($fileName) . ' 2>&1';

        // There is the possibility to pass "--ide" as an option to the analyzer.
        // This would result in an output format which would be easier to parse.
        // The problem here is that no cleartext error messages are returned; only
        // error-code-labels. So for a start we go for cleartext output.
        $exitCode = exec($cmd, $output, $retval);

        // Variable $exitCode is the last line of $output if no error occurs, on
        // error it is numeric. Try to handle various error conditions and
        // provide useful error reporting.
        if (true === is_numeric($exitCode) && $exitCode > 0) {
            if (true === \is_array($output)) {
                $msg = implode('\n', $output);
            }

            throw new RuntimeException("Failed invoking ZendCodeAnalyzer, exitcode was [{$exitCode}], retval was [{$retval}], output was [{$msg}]");
        }

        if (true === \is_array($output)) {
            foreach ($output as $finding) {
                // The first two lines of analyzer output contain
                // something like this:
                // > Zend Code Analyzer 1.2.2
                // > Analyzing <filename>...
                // So skip these...
                $res = preg_match('/^.+\\(line ([0-9]+)\\):(.+)$/', $finding, $regs);
                if (true === empty($regs) || false === $res) {
                    continue;
                }

                $phpcsFile->addWarningOnLine(trim($regs[2]), $regs[1], 'ExternalTool');
            }
        }

        // Ignore the rest of the file.
        return $phpcsFile->numTokens + 1;
    }

    //end process()
}//end class
