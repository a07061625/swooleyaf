<?php

namespace League\CLImate\Util\Writer;

class StdErr implements WriterInterface
{
    /**
     * Write the content to the stream
     *
     * @param  string $content
     */
    public function write($content)
    {
        fwrite(\STDERR, $content);
    }
}
