<?php

namespace League\CLImate\Util\System;

class Windows extends System
{
    /**
     * Get the width of the terminal
     *
     * @return integer|null
     */
    public function width()
    {
        return $this->getDimension('width');
    }

    /**
     * Get the height of the terminal
     *
     * @return integer|null
     */
    public function height()
    {
        return $this->getDimension('height');
    }

    /**
     * Get specified terminal dimension
     *
     * @param string $key
     *
     * @return integer|null
     */

    protected function getDimension($key)
    {
        $index      = array_search($key, ['height', 'width']);
        $dimensions = $this->getDimensions();

        return (!empty($dimensions[$index])) ? $dimensions[$index] : null;
    }

    /**
     * Get information about the dimensions of the terminal
     *
     * @return array
     */
    protected function getDimensions()
    {
        $output = $this->exec('mode CON', true);

        if (!is_array($output)) {
            return [];
        }

        $output = implode("\n", $output);

        preg_match_all('/.*:\s*(\d+)/', $output, $matches);

        return (!empty($matches[1])) ? $matches[1] : [];
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
        return (function_exists('sapi_windows_vt100_support') && @sapi_windows_vt100_support(STDOUT))
            || false !== getenv('ANSICON')
            || 'ON' === getenv('ConEmuANSI')
            || 'Hyper' === getenv('TERM_PROGRAM') 
            || 'xterm' === getenv('TERM');
    }
}
