<?php

namespace AlibabaCloud\Client;

use AlibabaCloud\Client\Exception\ClientException;
use Closure;
use League\CLImate\CLImate;
use Stringy\Stringy;

/*
|--------------------------------------------------------------------------
| Global Functions for Alibaba Cloud
|--------------------------------------------------------------------------
|
| Some common global functions are defined here.
| This file will be automatically loaded.
|
*/

/**
 * @param      $filename
 * @param bool $throwException
 *
 * @return bool
 *
 * @throws ClientException
 */
function inOpenBasedir($filename, $throwException = false)
{
    $open_basedir = ini_get('open_basedir');
    if (!$open_basedir) {
        return true;
    }

    $dirs = explode(PATH_SEPARATOR, $open_basedir);
    if (empty($dirs)) {
        return true;
    }

    if (inDir($filename, $dirs)) {
        return true;
    }

    if (false === $throwException) {
        return false;
    }

    throw new ClientException(
        'open_basedir restriction in effect. ' . "File({$filename}) is not within the allowed path(s): ({$open_basedir})",
        'SDK.InvalidPath'
    );
}

/**
 * @param string $filename
 *
 * @return bool
 */
function inDir($filename, array $dirs)
{
    foreach ($dirs as $dir) {
        if (!Stringy::create($dir)->endsWith(\DIRECTORY_SEPARATOR)) {
            $dir .= \DIRECTORY_SEPARATOR;
        }

        if (0 === strpos($filename, $dir)) {
            return true;
        }
    }

    return false;
}

/**
 * @return bool
 */
function isWindows()
{
    return PATH_SEPARATOR === ';';
}

/**
 * @return CLImate
 */
function cliMate()
{
    return new CLImate();
}

/**
 * @param string      $string
 * @param null|string $flank
 * @param null|string $char
 * @param null|int    $length
 */
function backgroundRed($string, $flank = null, $char = null, $length = null)
{
    cliMate()->br();
    if (null !== $flank) {
        cliMate()->backgroundRed()->flank($flank, $char, $length);
        cliMate()->br();
    }
    cliMate()->backgroundRed($string);
    cliMate()->br();
}

/**
 * @param string      $string
 * @param null|string $flank
 * @param null|string $char
 * @param null|int    $length
 */
function backgroundGreen($string, $flank = null, $char = null, $length = null)
{
    cliMate()->br();
    if (null !== $flank) {
        cliMate()->backgroundGreen()->flank($flank, $char, $length);
    }
    cliMate()->backgroundGreen($string);
    cliMate()->br();
}

/**
 * @param string      $string
 * @param null|string $flank
 * @param null|string $char
 * @param null|int    $length
 */
function backgroundBlue($string, $flank = null, $char = null, $length = null)
{
    cliMate()->br();
    if (null !== $flank) {
        cliMate()->backgroundBlue()->flank($flank, $char, $length);
    }
    cliMate()->backgroundBlue($string);
    cliMate()->br();
}

/**
 * @param string      $string
 * @param null|string $flank
 * @param null|string $char
 * @param null|int    $length
 */
function backgroundMagenta($string, $flank = null, $char = null, $length = null)
{
    cliMate()->br();
    if (null !== $flank) {
        cliMate()->backgroundMagenta()->flank($flank, $char, $length);
    }
    cliMate()->backgroundMagenta($string);
    cliMate()->br();
}

function json(array $array)
{
    cliMate()->br();
    cliMate()->backgroundGreen()->json($array);
    cliMate()->br();
}

/**
 * @param array $array
 */
function redTable($array)
{
    // @noinspection PhpUndefinedMethodInspection
    cliMate()->redTable($array);
}

/**
 * @param mixed  $result
 * @param string $title
 */
function block($result, $title)
{
    cliMate()->backgroundGreen()->flank($title, '--', 20);
    dump($result);
}

/**
 * Gets the value of an environment variable.
 *
 * @param string $key
 * @param mixed  $default
 *
 * @return mixed
 */
function env($key, $default = null)
{
    $value = getenv($key);

    if (false === $value) {
        return value($default);
    }

    if (envSubstr($value)) {
        return substr($value, 1, -1);
    }

    return envConversion($value);
}

/**
 * @param $value
 *
 * @return null|bool|string
 */
function envConversion($value)
{
    $key = strtolower($value);

    if ('null' === $key || '(null)' === $key) {
        return;
    }

    $list = [
        'true' => true,
        '(true)' => true,
        'false' => false,
        '(false)' => false,
        'empty' => '',
        '(empty)' => '',
    ];

    return isset($list[$key]) ? $list[$key] : $value;
}

/**
 * @param $key
 *
 * @return bool|mixed
 *
 * @throws ClientException
 */
function envNotEmpty($key)
{
    $value = env($key, false);
    if (false !== $value && !$value) {
        throw new ClientException("Environment variable '{$key}' cannot be empty", SDK::INVALID_ARGUMENT);
    }
    if ($value) {
        return $value;
    }

    return false;
}

/**
 * @param $value
 *
 * @return bool
 */
function envSubstr($value)
{
    return ($valueLength = \strlen($value)) > 1 && 0 === strpos($value, '"') && '"' === $value[$valueLength - 1];
}

/**
 * Return the default value of the given value.
 *
 * @param mixed $value
 *
 * @return mixed
 */
function value($value)
{
    return $value instanceof Closure ? $value() : $value;
}
