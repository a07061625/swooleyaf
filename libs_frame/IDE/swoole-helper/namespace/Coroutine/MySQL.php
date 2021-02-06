<?php

namespace Swoole\Coroutine;

/**
 * @since 4.6.2
 */
class MySQL
{
    /**
     * @return mixed
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function __destruct()
    {
    }

    /**
     * @return mixed
     */
    public function getDefer()
    {
    }

    /**
     * @param $defer[optional]
     *
     * @return mixed
     */
    public function setDefer($defer = null)
    {
    }

    /**
     * @param $server_config[optional]
     *
     * @return mixed
     */
    public function connect($server_config = null)
    {
    }

    /**
     * @param $sql[required]
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public function query($sql, $timeout = null)
    {
    }

    /**
     * @return mixed
     */
    public function fetch()
    {
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
    }

    /**
     * @return mixed
     */
    public function nextResult()
    {
    }

    /**
     * @param $query[required]
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public function prepare($query, $timeout = null)
    {
    }

    /**
     * @return mixed
     */
    public function recv()
    {
    }

    /**
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public function begin($timeout = null)
    {
    }

    /**
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public function commit($timeout = null)
    {
    }

    /**
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public function rollback($timeout = null)
    {
    }

    /**
     * @return mixed
     */
    public function close()
    {
    }
}
