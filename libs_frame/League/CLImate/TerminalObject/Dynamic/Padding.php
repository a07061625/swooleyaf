<?php

namespace League\CLImate\TerminalObject\Dynamic;

class Padding extends DynamicTerminalObject
{
    /**
     * The length that lines should be padded to
     *
     * @var int
     */
    protected $length = 0;

    /**
     * The character(s) that should be used to pad
     *
     * @var string
     */
    protected $char = '.';

    /**
     * If they pass in a padding character, set the char
     *
     * @param int    $length
     * @param string $char
     */
    public function __construct($length = null, $char = null)
    {
        if (null !== $length) {
            $this->length($length);
        }

        if (\is_string($char)) {
            $this->char($char);
        }
    }

    /**
     * Set the character(s) that should be used to pad
     *
     * @param string $char
     *
     * @return \League\CLImate\TerminalObject\Dynamic\Padding
     */
    public function char($char)
    {
        $this->char = $char;

        return $this;
    }

    /**
     * Set the length of the line that should be generated
     *
     * @param int $length
     *
     * @return \League\CLImate\TerminalObject\Dynamic\Padding
     */
    public function length($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Output the content and pad to the previously defined length
     *
     * @param string $content
     *
     * @return \League\CLImate\TerminalObject\Dynamic\Padding
     */
    public function label($content)
    {
        // Handle long labels by splitting them across several lines
        $lines = [];
        $stop = mb_strlen($content);
        $width = $this->util->width();
        for ($i = 0; $i < $stop; $i += $width) {
            $lines[] = mb_substr($content, $i, $width);
        }
        $content = array_pop($lines);

        foreach ($lines as $line) {
            $this->output->write($this->parser->apply($line));
        }

        $content = $this->padContent($content);
        $content = $this->parser->apply($content);

        $this->output->sameLine();
        $this->output->write($content);

        return $this;
    }

    /**
     * Output result
     *
     * @param string $content
     */
    public function result($content)
    {
        $this->output->write($this->parser->apply(' ' . $content));
    }

    /**
     * Get the length of the line based on the width of the terminal window
     *
     * @return int
     */
    protected function getLength()
    {
        if (!$this->length) {
            $this->length = $this->util->width();
        }

        return $this->length;
    }

    /**
     * Pad the content with the characters
     *
     * @param string $content
     *
     * @return string
     */
    protected function padContent($content)
    {
        if (\strlen($this->char) > 0) {
            $length = $this->getLength();
            $padding_length = ceil($length / mb_strlen($this->char));

            $padding = str_repeat($this->char, $padding_length);
            $content .= mb_substr($padding, 0, $length - mb_strlen($content));
        }

        return $content;
    }
}
