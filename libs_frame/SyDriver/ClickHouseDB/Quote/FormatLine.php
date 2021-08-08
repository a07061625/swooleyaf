<?php

namespace ClickHouseDB\Quote;

class FormatLine
{
    /**
     * @var array
     */
    private static $strict = [];

    /**
     * Format
     *
     * @param string $format
     *
     * @return StrictQuoteLine
     */
    public static function strictQuote($format)
    {
        if (empty(self::$strict[$format])) {
            self::$strict[$format] = new StrictQuoteLine($format);
        }

        return self::$strict[$format];
    }

    /**
     * Array in a string for a query Insert
     *
     * @param mixed[] $row
     *
     * @return string
     */
    public static function Insert(array $row, bool $skipEncode = false)
    {
        return self::strictQuote('Insert')->quoteRow($row, $skipEncode);
    }

    /**
     * Array to TSV
     *
     * @return string
     */
    public static function TSV(array $row)
    {
        return self::strictQuote('TSV')->quoteRow($row);
    }

    /**
     * Array to CSV
     *
     * @return string
     */
    public static function CSV(array $row)
    {
        return self::strictQuote('CSV')->quoteRow($row);
    }
}
