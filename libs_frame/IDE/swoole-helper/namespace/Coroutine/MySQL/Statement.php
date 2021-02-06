<?php

namespace Swoole\Coroutine\MySQL;

/**
 * @since 4.6.2
 */
class Statement
{
    /**
     * @param $params[optional]
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public function execute($params = null, $timeout = null)
    {
    }

    /**
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public function fetch($timeout = null)
    {
    }

    /**
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public function fetchAll($timeout = null)
    {
    }

    /**
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public function nextResult($timeout = null)
    {
    }

    /**
     * @param $timeout[optional]
     *
     * @return mixed
     */
    public function recv($timeout = null)
    {
    }

    /**
     * @return mixed
     */
    public function close()
    {
    }
}
