<?php

namespace Swoole\Process;

/**
 * @since 4.6.2
 */
class Pool
{
    /**
     * @param $worker_num[required]
     * @param $ipc_type[optional]
     * @param $msgqueue_key[optional]
     * @param $enable_coroutine[optional]
     *
     * @return mixed
     */
    public function __construct($worker_num, $ipc_type = null, $msgqueue_key = null, $enable_coroutine = null)
    {
    }

    /**
     * @return mixed
     */
    public function __destruct()
    {
    }

    /**
     * @param $settings[required]
     *
     * @return mixed
     */
    public function set($settings)
    {
    }

    /**
     * @param $event_name[required]
     * @param $callback[required]
     *
     * @return mixed
     */
    public function on($event_name, $callback)
    {
    }

    /**
     * @param $worker_id[optional]
     *
     * @return mixed
     */
    public function getProcess($worker_id = null)
    {
    }

    /**
     * @param $host[required]
     * @param $port[optional]
     * @param $backlog[optional]
     *
     * @return mixed
     */
    public function listen($host, $port = null, $backlog = null)
    {
    }

    /**
     * @param $data[required]
     *
     * @return mixed
     */
    public function write($data)
    {
    }

    /**
     * @return mixed
     */
    public function start()
    {
    }

    /**
     * @return mixed
     */
    public function shutdown()
    {
    }
}
