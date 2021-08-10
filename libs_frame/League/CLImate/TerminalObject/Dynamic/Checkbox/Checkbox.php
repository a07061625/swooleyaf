<?php

namespace League\CLImate\TerminalObject\Dynamic\Checkbox;

use League\CLImate\Decorator\Parser\ParserImporter;
use League\CLImate\TerminalObject\Helper\StringLength;
use League\CLImate\Util\UtilImporter;

class Checkbox
{
    use StringLength;
    use ParserImporter;
    use UtilImporter;

    /**
     * The value of the checkbox
     *
     * @var bool|int|string
     */
    protected $value;

    /**
     * The label for the checkbox
     *
     * @var int|string
     */
    protected $label;

    /**
     * Whether the checkbox is checked
     *
     * @var bool
     */
    protected $checked = false;

    /**
     * Whether pointer is currently pointing at the checkbox
     *
     * @var bool
     */
    protected $current = false;

    /**
     * Whether the checkbox is the first in the group
     *
     * @var bool
     */
    protected $first = false;

    /**
     * Whether the checkbox is the last in the group
     *
     * @var bool
     */
    protected $last = false;

    public function __construct($label, $value)
    {
        $this->value = (!\is_int($value)) ? $value : $label;
        $this->label = $label;
    }

    public function __toString()
    {
        if ($this->isFirst()) {
            return $this->buildCheckboxString();
        }

        if ($this->isLast()) {
            return $this->buildCheckboxString() . $this->util->cursor->left(10) . '<hidden>';
        }

        return $this->buildCheckboxString();
    }

    /**
     * @return bool
     */
    public function isCurrent()
    {
        return $this->current;
    }

    /**
     * @return bool
     */
    public function isChecked()
    {
        return $this->checked;
    }

    /**
     * @return bool
     */
    public function isFirst()
    {
        return $this->first;
    }

    /**
     * @return bool
     */
    public function isLast()
    {
        return $this->last;
    }

    /**
     * Set whether the pointer is currently pointing at this checkbox
     *
     * @param bool $current
     *
     * @return Checkbox
     */
    public function setCurrent($current = true)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Set whether the checkbox is currently checked
     *
     * @param bool $checked
     *
     * @return Checkbox
     */
    public function setChecked($checked = true)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * @return Checkbox
     */
    public function setFirst()
    {
        $this->first = true;

        return $this;
    }

    /**
     * @return Checkbox
     */
    public function setLast()
    {
        $this->last = true;

        return $this;
    }

    /**
     * @return bool|int|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Build out basic checkbox string based on current options
     *
     * @return string
     */
    protected function buildCheckboxString()
    {
        $parts = [
            ($this->isCurrent()) ? $this->pointer() : ' ',
            $this->checkbox($this->isChecked()),
            $this->label,
        ];

        $line = implode(' ', $parts);

        return $line . $this->getPaddingString($line);
    }

    /**
     * Get the padding string based on the length of the terminal/line
     *
     * @param string $line
     *
     * @return string
     */
    protected function getPaddingString($line)
    {
        $length = $this->util->width() - $this->lengthWithoutTags($line);
        if ($length < 1) {
            return '';
        }

        return str_repeat(' ', $length);
    }

    /**
     * Get the checkbox symbol
     *
     * @param bool $checked
     *
     * @return string
     */
    protected function checkbox($checked)
    {
        if ($checked) {
            return html_entity_decode('&#x25CF;');
        }

        return html_entity_decode('&#x25CB;');
    }

    /**
     * Get the pointer symbol
     *
     * @return string
     */
    protected function pointer()
    {
        return html_entity_decode('&#x276F;');
    }
}
