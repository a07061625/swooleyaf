<?php

declare(strict_types = 1);

namespace ClickHouseDB\Query\Degeneration;

use function array_map;
use ClickHouseDB\Query\Degeneration;
use ClickHouseDB\Quote\ValueFormatter;
use function implode;

class Bindings implements Degeneration
{
    /**
     * @var array
     */
    protected $bindings = [];

    public function bindParams(array $bindings)
    {
        $this->bindings = [];
        foreach ($bindings as $column => $value) {
            $this->bindParam($column, $value);
        }
    }

    /**
     * @param string $column
     * @param mixed  $value
     */
    public function bindParam($column, $value)
    {
        $this->bindings[$column] = $value;
    }

    /**
     * Binds a list of values to the corresponding parameters.
     * This is similar to [[bindValue()]] except that it binds multiple values at a time.
     *
     * @param string $sql
     * @param array  $binds
     * @param string $pattern
     *
     * @return string
     */
    public function compile_binds($sql, $binds, $pattern)
    {
        return preg_replace_callback($pattern, function ($m) use ($binds) {
            if (isset($binds[$m[1]])) { // If it exists in our array
                return $binds[$m[1]]; // Then replace it from our array
            }

            return $m[0]; // Otherwise return the whole match (basically we won't change it)
        }, $sql);
    }

    /**
     * Compile Bindings
     *
     * @param string $sql
     *
     * @return mixed
     */
    public function process($sql)
    {
        $bindFormatted = [];
        $bindRaw = [];
        foreach ($this->bindings as $key => $value) {
            if (\is_array($value)) {
                $valueSet = implode(', ', $value);

                $values = array_map(
                    function ($value) {
                        return ValueFormatter::formatValue($value);
                    },
                    $value
                );

                $formattedParameter = implode(',', $values);
            } else {
                $valueSet = $value;
                $formattedParameter = ValueFormatter::formatValue($value);
            }

            if (null !== $formattedParameter) {
                $bindFormatted[$key] = $formattedParameter;
            }

            if (null !== $valueSet) {
                $bindRaw[$key] = $valueSet;
            }
        }

        for ($loop = 0; $loop < 2; ++$loop) {
            // dipping in binds
            // example ['A' => '{B}' , 'B'=>':C','C'=>123]
            $sql = $this->compile_binds($sql, $bindRaw, '#{([\w+]+)}#');
        }

        return $this->compile_binds($sql, $bindFormatted, '#:([\w+]+)#');
    }
}
