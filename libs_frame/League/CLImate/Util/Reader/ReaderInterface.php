<?php

namespace League\CLImate\Util\Reader;

interface ReaderInterface
{
    /**
     * @return string
     */
    public function line();

    /**
     * @return string
     */
    public function multiLine();
}
