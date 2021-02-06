<?php

namespace Swoole;

/**
 * @since 4.6.2
 */
class Event
{
    /**
     * @param $fd[required]
     * @param $read_callback[required]
     * @param $write_callback[optional]
     * @param $events[optional]
     *
     * @return mixed
     */
    public static function add($fd, $read_callback, $write_callback = null, $events = null)
    {
    }

    /**
     * @param $fd[required]
     *
     * @return mixed
     */
    public static function del($fd)
    {
    }

    /**
     * @param $fd[required]
     * @param $read_callback[optional]
     * @param $write_callback[optional]
     * @param $events[optional]
     *
     * @return mixed
     */
    public static function set($fd, $read_callback = null, $write_callback = null, $events = null)
    {
    }

    /**
     * @param $fd[required]
     * @param $events[optional]
     *
     * @return mixed
     */
    public static function isset($fd, $events = null)
    {
    }

    /**
     * @return mixed
     */
    public static function dispatch()
    {
    }

    /**
     * @param $callback[required]
     *
     * @return mixed
     */
    public static function defer($callback)
    {
    }

    /**
     * @param $callback[required]
     * @param $before[optional]
     *
     * @return mixed
     */
    public static function cycle($callback, $before = null)
    {
    }

    /**
     * @param $fd[required]
     * @param $data[required]
     *
     * @return mixed
     */
    public static function write($fd, $data)
    {
    }

    /**
     * @return mixed
     */
    public static function wait()
    {
    }

    /**
     * @return mixed
     */
    public static function rshutdown()
    {
    }

    /**
     * @return mixed
     */
    public static function _exit()
    {
    }
}
