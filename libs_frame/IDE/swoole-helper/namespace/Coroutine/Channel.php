<?php
namespace Swoole\Coroutine;

/**
 * @since 4.4.3
 */
class Channel
{


    /**
     * @param $size[optional]
     * @return mixed
     */
    public function __construct($size=null){}

    /**
     * @param $data[required]
     * @param $timeout[optional]
     * @return mixed
     */
    public function push($data, $timeout=null){}

    /**
     * @param $timeout[optional]
     * @return mixed
     */
    public function pop($timeout=null){}

    /**
     * @return mixed
     */
    public function isEmpty(){}

    /**
     * @return mixed
     */
    public function isFull(){}

    /**
     * @return mixed
     */
    public function close(){}

    /**
     * @return mixed
     */
    public function stats(){}

    /**
     * @return mixed
     */
    public function length(){}


}
