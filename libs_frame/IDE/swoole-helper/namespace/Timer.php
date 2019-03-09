<?php
namespace Swoole;

/**
 * @since 4.3.0
 */
class Timer
{


    /**
     * @param $ms[required]
     * @param $callback[required]
     * @param $params[optional]
     * @return mixed
     */
    public static function tick($ms, $callback, $params=null){}

    /**
     * @param $ms[required]
     * @param $callback[required]
     * @param $params[optional]
     * @return mixed
     */
    public static function after($ms, $callback, $params=null){}

    /**
     * @param $timer_id[required]
     * @return mixed
     */
    public static function exists($timer_id){}

    /**
     * @param $timer_id[required]
     * @return mixed
     */
    public static function clear($timer_id){}


}
