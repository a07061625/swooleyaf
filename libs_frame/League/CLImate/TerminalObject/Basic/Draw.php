<?php

namespace League\CLImate\TerminalObject\Basic;

use League\CLImate\TerminalObject\Helper\Art;

class Draw extends BasicTerminalObject
{
    use Art;

    public function __construct($art)
    {
        // Add the default art directory
        $this->addDir(__DIR__ . \DIRECTORY_SEPARATOR);

        $this->art = $art;
    }

    /**
     * Return the art
     *
     * @return array
     */
    public function result()
    {
        $file = $this->artFile($this->art);

        return $this->parse($file);
    }
}
