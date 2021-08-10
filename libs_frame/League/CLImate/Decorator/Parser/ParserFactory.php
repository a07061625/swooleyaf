<?php

namespace League\CLImate\Decorator\Parser;

use League\CLImate\Decorator\Tags;
use League\CLImate\Util\System\System;

class ParserFactory
{
    /**
     * Get an instance of the appropriate Parser class
     *
     * @return Parser
     */
    public static function getInstance(System $system, array $current, Tags $tags)
    {
        if ($system->hasAnsiSupport()) {
            return new Ansi($current, $tags);
        }

        return new NonAnsi($current, $tags);
    }
}
