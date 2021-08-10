<?php

namespace League\CLImate\Util\System;

use function getenv;

class Linux extends System
{
    /**
     * Get the width of the terminal
     *
     * @return null|int
     */
    public function width()
    {
        return $this->getDimension($this->tput('cols'));
    }

    /**
     * Get the height of the terminal
     *
     * @return null|int
     */
    public function height()
    {
        return $this->getDimension($this->tput('lines'));
    }

    /**
     * Determine if system has access to bash commands
     *
     * @return bool
     */
    public function canAccessBash()
    {
        return 'OK' === rtrim($this->exec("/usr/bin/env bash -c 'echo OK'"));
    }

    /**
     * Display a hidden response prompt and return the response
     *
     * @param string $prompt
     *
     * @return string
     */
    public function hiddenResponsePrompt($prompt)
    {
        $bash_command = 'read -s -p "' . $prompt . '" response && echo $response';

        return rtrim($this->exec("/usr/bin/env bash -c '{$bash_command}'"));
    }

    /**
     * Determine if dimension is numeric and return it
     *
     * @param null|int|string $dimension
     *
     * @return null|int
     */
    protected function getDimension($dimension)
    {
        return (is_numeric($dimension)) ? $dimension : null;
    }

    /**
     * Check if the stream supports ansi escape characters.
     *
     * Based on https://github.com/symfony/symfony/blob/master/src/Symfony/Component/Console/Output/StreamOutput.php
     *
     * @return bool
     */
    protected function systemHasAnsiSupport()
    {
        if ('Hyper' === getenv('TERM_PROGRAM')) {
            return true;
        }

        $stream = STDOUT;

        if (\function_exists('stream_isatty')) {
            return @stream_isatty($stream);
        }

        if (\function_exists('posix_isatty')) {
            return @posix_isatty($stream);
        }

        $stat = @fstat($stream);
        // Check if formatted mode is S_IFCHR
        return $stat ? 0020000 === ($stat['mode'] & 0170000) : false;
    }

    /**
     * Get a value from the tput command.
     *
     * @param string $type
     *
     * @return null|array|string
     */
    private function tput($type)
    {
        return $this->exec("tput {$type} 2>/dev/null");
    }
}
