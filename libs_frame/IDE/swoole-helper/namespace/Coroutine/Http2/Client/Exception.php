<?php
namespace Swoole\Coroutine\Http2\Client;

/**
 * @since 4.4.3
 */
class Exception extends \Swoole\Exception
{


    /**
     * @param $message[optional]
     * @param $code[optional]
     * @param $previous[optional]
     * @return mixed
     */
    public function __construct($message=null, $code=null, $previous=null){}

    /**
     * @return mixed
     */
    public function __wakeup(){}

    /**
     * @return mixed
     */
    public function __toString(){}


}
