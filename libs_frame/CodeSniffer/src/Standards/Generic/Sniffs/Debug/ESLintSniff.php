<?php
/**
 * Runs eslint on the file.
 *
 * @author    Ryan McCue <ryan+gh@hmn.md>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\Debug;

use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ESLintSniff implements Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = ['JS'];

    /**
     * ESLint configuration file path.
     *
     * @var null|string Path to eslintrc. Null to autodetect.
     */
    public $configFile;

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
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException If jshint.js could not be run
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $eslintPath = Config::getExecutablePath('eslint');
        if (null === $eslintPath) {
            return;
        }

        $filename = $phpcsFile->getFilename();

        $configFile = $this->configFile;
        if (true === empty($configFile)) {
            // Attempt to autodetect.
            $candidates = glob('.eslintrc{.js,.yaml,.yml,.json}', GLOB_BRACE);
            if (false === empty($candidates)) {
                $configFile = $candidates[0];
            }
        }

        $eslintOptions = ['--format json'];
        if (false === empty($configFile)) {
            $eslintOptions[] = '--config ' . escapeshellarg($configFile);
        }

        $cmd = escapeshellcmd(escapeshellarg($eslintPath) . ' ' . implode(' ', $eslintOptions) . ' ' . escapeshellarg($filename));

        // Execute!
        exec($cmd, $stdout, $code);

        if ($code <= 0) {
            // No errors, continue.
            return $phpcsFile->numTokens + 1;
        }

        $data = json_decode(implode("\n", $stdout));
        if (JSON_ERROR_NONE !== json_last_error()) {
            // Ignore any errors.
            return $phpcsFile->numTokens + 1;
        }

        // Data is a list of files, but we only pass a single one.
        $messages = $data[0]->messages;
        foreach ($messages as $error) {
            $message = 'eslint says: ' . $error->message;
            if (false === empty($error->fatal) || 2 === $error->severity) {
                $phpcsFile->addErrorOnLine($message, $error->line, 'ExternalTool');
            } else {
                $phpcsFile->addWarningOnLine($message, $error->line, 'ExternalTool');
            }
        }

        // Ignore the rest of the file.
        return $phpcsFile->numTokens + 1;
    }

    //end process()
}//end class
