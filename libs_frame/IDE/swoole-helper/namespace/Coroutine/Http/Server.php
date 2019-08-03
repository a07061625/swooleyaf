<?php
namespace Swoole\Coroutine\Http;

/**
 * @since 4.4.3
 */
class Server
{


    /**
     * @return mixed
     */
    public function __construct(){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param $settings[required]
     * @return mixed
     */
    public function set($settings){}

    /**
     * @param $pattern[required]
     * @param $callback[required]
     * @return mixed
     */
    public function handle($pattern, $callback){}

    /**
     * @return mixed
     */
    public function onAccept(){}

    /**
     * @return mixed
     */
    public function start(){}

    /**
     * @return mixed
     */
    public function shutdown(){}


}
