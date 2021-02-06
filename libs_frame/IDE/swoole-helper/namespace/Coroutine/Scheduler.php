<?php

namespace Swoole\Coroutine;

/**
 * @since 4.6.2
 */
class Scheduler
{
    /**
     * @param $func[required]
     * @param $params[optional]
     *
     * @return mixed
     */
    public function add($func, $params = null)
    {
    }

    /**
     * @param $n[required]
     * @param $func[optional]
     * @param $params[optional]
     *
     * @return mixed
     */
    public function parallel($n, $func = null, $params = null)
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
     * @return mixed
     */
    public function getOptions()
    {
    }

    /**
     * @return mixed
     */
    public function start()
    {
    }
}
