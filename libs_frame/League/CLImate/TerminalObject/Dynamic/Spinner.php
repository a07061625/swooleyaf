<?php

namespace League\CLImate\TerminalObject\Dynamic;

use function array_merge;
use League\CLImate\Exceptions\UnexpectedValueException;
use function microtime;
use function range;
use function str_repeat;
use function substr;
use function trim;

final class Spinner extends DynamicTerminalObject
{
    /**
     * @var string[] the characters to be used to present progress
     */
    private $characters = ['[=---]', '[-=--]', '[--=-]', '[---=]', '[--=-]', '[-=--]'];

    /**
     * @var int The current item of the sequence
     */
    private $current = 0;

    /**
     * @var bool flag indicating whether we are writing the bar for the first time
     */
    private $firstLine = true;

    /**
     * @var string current label
     */
    private $label;

    /**
     * @var float when the spinner was last drawn
     */
    private $lastDrawn;

    /**
     * @var float how long to wait in seconds between drawing each stage
     */
    private $timeLimit = 0.1;

    /**
     * If they pass in a sequence, set the sequence
     *
     * @param string $label
     * @param string ...$characters
     */
    public function __construct($label = null, ...$characters)
    {
        if (null !== $label) {
            $this->label = $label;
        }

        if (\count($characters) < 1) {
            $characters = [];
            $size = 5;
            $positions = array_merge(range(0, $size - 1), range($size - 2, 1, -1));
            foreach ($positions as $pos) {
                $line = str_repeat('-', $size);
                $characters[] = '[' . substr($line, 0, $pos) . '=' . substr($line, $pos + 1) . ']';
            }
        }
        $this->characters(...$characters);
    }

    /**
     * Set the length of time to wait between drawing each stage.
     *
     * @param float $timeLimit
     *
     * @return Spinner
     */
    public function timeLimit($timeLimit)
    {
        $this->timeLimit = (float)$timeLimit;

        return $this;
    }

    /**
     * Set the character to loop around.
     *
     * @param string $characters
     *
     * @return Spinner
     */
    public function characters(...$characters)
    {
        if (\count($characters) < 1) {
            throw new UnexpectedValueException('You must specify the characters to use');
        }

        $this->characters = $characters;

        return $this;
    }

    /**
     * Re-writes the spinner
     *
     * @param string $label
     */
    public function advance($label = null)
    {
        if (null === $label) {
            $label = $this->label;
        }

        if ($this->lastDrawn) {
            $time = microtime(true) - $this->lastDrawn;
            if ($time < $this->timeLimit) {
                return;
            }
        }

        ++$this->current;
        if ($this->current >= \count($this->characters)) {
            $this->current = 0;
        }

        $characters = $this->characters[$this->current];
        $this->drawSpinner($characters, $label);
        $this->lastDrawn = microtime(true);
    }

    /**
     * Draw the spinner
     *
     * @param string $characters
     * @param string $label
     */
    private function drawSpinner($characters, $label)
    {
        $spinner = '';

        if ($this->firstLine) {
            $this->firstLine = false;
        } else {
            $spinner .= $this->util->cursor->up(1);
            $spinner .= $this->util->cursor->startOfCurrentLine();
            $spinner .= $this->util->cursor->deleteCurrentLine();
        }

        $spinner .= trim("{$characters} {$label}");

        $this->output->write($this->parser->apply($spinner));
    }
}
