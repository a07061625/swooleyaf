<?php

namespace League\CLImate\TerminalObject\Basic;

use League\CLImate\Exceptions\InvalidArgumentException;
use League\CLImate\TerminalObject\Helper\StringLength;

use function array_keys;
use function count;
use function get_object_vars;
use function is_array;
use function is_object;
use function max;
use function preg_split;

class Table extends BasicTerminalObject
{
    use StringLength;

    /**
     * The data for the table, an array of (arrays|objects)
     *
     * @var array $data
     */
    protected $data           = [];

    /**
     * An array of the widths of each column in the table
     *
     * @var array $column_widths
     */
    protected $column_widths  = [];

    /**
     * The width of the table
     *
     * @var integer $table_width
     */
    protected $table_width    = 0;

    /**
     * The divider between table cells
     *
     * @var string $column_divider
     */
    protected $column_divider = ' | ';

    /**
     * The border to divide each row of the table
     *
     * @var string $border
     */
    protected $border;

    /**
     * The array of rows that will ultimately be returned
     *
     * @var array $rows
     */
    protected $rows           = [];

    /**
     * @var string $pregix A string to be output before each row is output.
     */
    private $prefix = "";


    public function __construct(array $data, $prefix = "")
    {
        $this->data = $this->getData($data);
        $this->prefix = $prefix;
    }


    /**
     * @param array $input
     *
     * @return array
     */
    private function getData(array $input)
    {
        $output = [];

        foreach ($input as $item) {
            if (is_object($item)) {
                $item = get_object_vars($item);
            }

            if (!is_array($item)) {
                throw new InvalidArgumentException("Invalid table data, you must pass an array of arrays or objects");
            }

            $output[] = $item;
        }

        return $this->splitRows($output);
    }

    /**
     * Split each row in $data into an array of arrays
     * Where each value represents a line in a cell
     *
     * @param array $data
     *
     * @return array
     */
    private function splitRows($data)
    {
        foreach ($data as $row_key => $row) {
            $height = 1;
            $lines = [];
            foreach ($row as $key => $column) {
                $lines[$key] = preg_split('/(\r\n|\r|\n)/u', $column);
                $height = max($height, count($lines[$key]));
            }
            $keys = array_keys($row);
            $new_rows = [];
            for ($i = 0; $i < $height; $i++) {
                $new_row = [];
                foreach ($keys as $key) {
                    $new_row[$key] = $lines[$key][$i] ?? '';
                }
                $new_rows[] = $new_row;
            }
            $data[$row_key] = $new_rows;
        }
        return $data;
    }


    /**
     * Return the built rows
     *
     * @return array
     */
    public function result()
    {
        $this->column_widths = $this->getColumnWidths();
        $this->table_width   = $this->getWidth();
        $this->border        = $this->getBorder();

        $this->buildHeaderRow();

        foreach ($this->data as $row_columns) {
            foreach ($row_columns as $columns) {
                $this->addLine($this->buildRow($columns));
            }
            $this->addLine($this->border);
        }

        return $this->rows;
    }

    /**
     * Append a line to the output.
     *
     * @param string $line The line to output
     *
     * @return void
     */
    private function addLine($line)
    {
        $this->rows[] = $this->prefix . $line;
    }


    /**
     * Determine the width of the table
     *
     * @return integer
     */
    protected function getWidth()
    {
        $first_row = reset($this->data);
        $first_row = reset($first_row);
        $first_row = $this->buildRow($first_row);

        return $this->lengthWithoutTags($first_row);
    }

    /**
     * Get the border for each row based on the table width
     */
    protected function getBorder()
    {
        return (new Border())->length($this->table_width)->result();
    }

    /**
     * Check for a header row (if it's an array of associative arrays or objects),
     * if there is one, tack it onto the front of the rows array
     */
    protected function buildHeaderRow()
    {
        $this->addLine($this->border);

        $header_row = $this->getHeaderRow();
        if ($header_row) {
            $this->addLine($this->buildRow($header_row));
            $this->addLine((new Border)->char('=')->length($this->table_width)->result());
        }
    }

    /**
     * Get table row
     *
     * @param  mixed  $columns
     *
     * @return string
     */
    protected function buildRow($columns)
    {
        $row = [];

        foreach ($columns as $key => $column) {
            $row[] = $this->buildCell($key, $column);
        }

        $row = implode($this->column_divider, $row);

        return trim($this->column_divider . $row . $this->column_divider);
    }

    /**
     * Build the string for this particular table cell
     *
     * @param  mixed  $key
     * @param  string $column
     *
     * @return string
     */
    protected function buildCell($key, $column)
    {
        return  $this->pad($column, $this->column_widths[$key]);
    }

    /**
     * Get the header row for the table if it's an associative array or object
     *
     * @return mixed
     */
    protected function getHeaderRow()
    {
        $first_item = reset($this->data);
        $first_item = reset($first_item);

        $keys       = array_keys($first_item);
        $first_key  = reset($keys);

        // We have an associative array (probably), let's have a header row
        if (!is_int($first_key)) {
            return array_combine($keys, $keys);
        }

        return false;
    }

    /**
     * Determine the width of each column
     *
     * @return array
     */
    protected function getColumnWidths()
    {
        $first_row = reset($this->data);
        $first_row = reset($first_row);

        // Create an array with the columns as keys and values of zero
        $column_widths = $this->getDefaultColumnWidths($first_row);

        foreach ($this->data as $row_columns) {
            foreach ($row_columns as $columns) {
                foreach ($columns as $key => $column) {
                    $column_widths[$key] = $this->getCellWidth($column_widths[$key], $column);
                }
            }
        }

        return $column_widths;
    }

    /**
     * Set up an array of default column widths
     *
     * @param array $columns
     *
     * @return array
     */
    protected function getDefaultColumnWidths(array $columns)
    {
        $widths = $this->arrayOfStrLens(array_keys($columns));

        return array_combine(array_keys($columns), $widths);
    }

    /**
     * Determine the width of the columns without tags
     *
     * @param array  $current_width
     * @param string $str
     *
     * @return integer
     */
    protected function getCellWidth($current_width, $str)
    {
        return max($current_width, $this->lengthWithoutTags($str));
    }
}
