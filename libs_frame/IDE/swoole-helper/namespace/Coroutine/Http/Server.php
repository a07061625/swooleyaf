<?php

namespace Swoole\Coroutine\Http;

/**
 * @since 4.6.2
 */
class Server
{
    /**
     * @param $host[required]
     * @param $port[optional]
     * @param $ssl[optional]
     * @param $reuse_port[optional]
     *
     * @return mixed
     */
    public function __construct($host, $port = null, $ssl = null, $reuse_port = null)
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
     * @param $pattern[required]
     * @param $callback[required]
     *
     * @return mixed
     */
    public function handle($pattern, $callback)
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

    /**
     * @return mixed
     */
    private function onAccept()
    {
    }
}
