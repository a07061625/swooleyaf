<?php

namespace League\CLImate\TerminalObject\Helper;

interface SleeperInterface
{
    /**
     * @param float|int $percentage
     */
    public function speed($percentage);

    public function sleep();
}
