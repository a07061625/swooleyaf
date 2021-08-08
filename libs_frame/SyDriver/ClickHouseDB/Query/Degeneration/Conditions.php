<?php

namespace ClickHouseDB\Query\Degeneration;

use ClickHouseDB\Exception\QueryException;
use ClickHouseDB\Query\Degeneration;

class Conditions implements Degeneration
{
    /**
     * @var array
     */
    protected $bindings = [];

    public static function __ifsets($matches, $markers)
    {
        $content_false = '';
        $condition = '';
        $flag_else = '';
        //print_r($matches);
        if (4 == count($matches)) {
            list($condition, $preset, $variable, $content_true) = $matches;
        } elseif (6 == count($matches)) {
            list($condition, $preset, $variable, $content_true, $flag_else, $content_false) = $matches;
        } else {
            throw new QueryException('Error in parse Conditions' . json_encode($matches));
        }
        $variable = trim($variable);
        $preset = strtolower(trim($preset));

        if ('' == $preset) {
            return (isset($markers[$variable]) && ($markers[$variable] || is_numeric($markers[$variable])))
                ? $content_true
                : $content_false;
        }
        if ('set' == $preset) {
            return (isset($markers[$variable]) && !empty($markers[$variable])) ? $content_true : $content_false;
        }
        if ('bool' == $preset) {
            return (isset($markers[$variable]) && \is_bool($markers[$variable]) && true == $markers[$variable])
                ? $content_true
                : $content_false;
        }
        if ('string' == $preset) {
            return (isset($markers[$variable]) && \is_string($markers[$variable]) && \strlen($markers[$variable]))
                ? $content_true
                : $content_false;
        }
        if ('int' == $preset) {
            return (isset($markers[$variable]) && 0 != (int)($markers[$variable]))
                ? $content_true
                : $content_false;
        }

        return '';
    }

    public function bindParams(array $bindings)
    {
        foreach ($bindings as $column => $value) {
            $this->bindings[$column] = $value;
        }
    }

    /**
     * @param string $sql
     *
     * @return mixed
     */
    public function process($sql)
    {
        $markers = $this->bindings;

        // ------ if/else conditions & if[set|int]/else conditions -----
        return preg_replace_callback('#\{if(.{0,}?)\s+([^\}]+?)\}(.+?)(\{else\}([^\{]+?)?)?\s*\{\/if}#sui', function ($matches) use ($markers) {
            return self::__ifsets($matches, $markers);
        }, $sql);
        // $ifint var ELSE  {ENDIF}

        // stackoverflow
        // if(whatever) {  } else { adsffdsa } else if() { }
        // /^if\s*\((.*?)\)\s*{(.*?)}(\s*(else|else\s+if\s*\((.*?)\))\s*{(.*?)})*/
        // if (condition_function(params)) {
        //     statements;
        //}
        // if\s*\(((?:(?:(?:"(?:(?:\\")|[^"])*")|(?:'(?:(?:\\')|[^'])*'))|[^\(\)]|\((?1)\))*+)\)\s*{((?:(?:(?:"(?:(?:\\")|[^"])*")|(?:'(?:(?:\\')|[^'])*'))|[^{}]|{(?2)})*+)}\s*(?:(?:else\s*{((?:(?:(?:"(?:(?:\\")|[^"])*")|(?:'(?:(?:\\')|[^'])*'))|[^{}]|{(?3)})*+)}\s*)|(?:else\s*if\s*\(((?:(?:(?:"(?:(?:\\")|[^"])*")|(?:'(?:(?:\\')|[^'])*'))|[^\(\)]|\((?4)\))*+)\)\s*{((?:(?:(?:"(?:(?:\\")|[^"])*")|(?:'(?:(?:\\')|[^'])*'))|[^{}]|{(?5)})*+)}\s*))*;
        // @if\s*\(\s*([^)]*)\s*\)\s*(((?!@if|@endif).)*)\s*(?:@else\s*(((?!@if|@endif).)*))?\s*@endif
        // @if \s* \( \s* ([^)]*)\s*\)\s*(((?!@if|@endif).)*)\s*(?:@else\s*(((?!@if|@endif).)*))?\s*@endif
        // [^}]

        //        // 3. process if conditions
        //        $sql = preg_replace_callback('#\{if\s(.+?)}(.+?)\{/if}#sui', function($matches) use ($markers) {
        //            list($condition, $variable, $content) = $matches;
        //            if (isset($markers[$variable]) && ($markers[$variable] || is_numeric($markers[$variable]))) {
        //                return $content;
        //            }
        //        }, $sql);

        // 1. process if[set|int]/else conditions
        //        $sql = preg_replace_callback('#\{if(.{1,}?)\s(.+?)}(.+?)\{else}(.+?)\{/if}#sui', function($matches) use ($markers) {return  self::__ifsets($matches, $markers, true); }, $sql);
        //        $sql = preg_replace_callback('#\{if(.{1,}?)\s(.+?)}(.+?)\{/if}#sui', function($matches) use ($markers) { return self::__ifsets($matches, $markers, false); }, $sql);
    }
}
