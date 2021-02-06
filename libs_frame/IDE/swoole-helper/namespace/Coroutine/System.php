<?php

namespace Swoole\Coroutine;

/**
 * @since 4.6.2
 */
class System
{
    /**
     * @param $domain_name[required]
     * @param $family[optional]
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public static function gethostbyname($domain_name, $family = null, $timeout = null)
    {
    }

    /**
     * @param $domain_name[required]
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public static function dnsLookup($domain_name, $timeout = null)
    {
    }

    /**
     * @param $command[required]
     * @param $get_error_stream[optional]
     *
     * @return mixed
     */
    public static function exec($command, $get_error_stream = null)
    {
    }

    /**
     * @param $seconds[required]
     *
     * @return mixed
     */
    public static function sleep($seconds)
    {
    }

    /**
     * @param $hostname[required]
     * @param $family[optional]
     * @param $socktype[optional]
     * @param $protocol[optional]
     * @param $service[optional]
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public static function getaddrinfo($hostname, $family = null, $socktype = null, $protocol = null, $service = null, $timeout = null)
    {
    }

    /**
     * @param $path[required]
     *
     * @return mixed
     */
    public static function statvfs($path)
    {
    }

    /**
     * @param $filename[required]
     *
     * @return mixed
     */
    public static function readFile($filename)
    {
    }

    /**
     * @param $filename[required]
     * @param $data[required]
     * @param $flags[optional]
     *
     * @return mixed
     */
    public static function writeFile($filename, $data, $flags = null)
    {
    }

    /**
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public static function wait($timeout = null)
    {
    }

    /**
     * @param $pid[required]
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public static function waitPid($pid, $timeout = null)
    {
    }

    /**
     * @param $signo[required]
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public static function waitSignal($signo, $timeout = null)
    {
    }

    /**
     * @param $fd[required]
     * @param $events[optional]
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public static function waitEvent($fd, $events = null, $timeout = null)
    {
    }

    /**
     * @param $handle[required]
     * @param $length[optional]
     *
     * @return mixed
     */
    public static function fread($handle, $length = null)
    {
    }

    /**
     * @param $handle[required]
     * @param $string[required]
     * @param $length[optional]
     *
     * @return mixed
     */
    public static function fwrite($handle, $string, $length = null)
    {
    }

    /**
     * @param $handle[required]
     *
     * @return mixed
     */
    public static function fgets($handle)
    {
    }
}
