<?php
namespace Swoole\Connection;

/**
 * @since 4.5.1
 */
class Iterator
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
     * @return mixed
     */
    public function rewind(){}

    /**
     * @return mixed
     */
    public function next(){}

    /**
     * @return mixed
     */
    public function current(){}

    /**
     * @return mixed
     */
    public function key(){}

    /**
     * @return mixed
     */
    public function valid(){}

    /**
     * @return mixed
     */
    public function count(){}

    /**
     * @param $fd[required]
     * @return mixed
     */
    public function offsetExists($fd){}

    /**
     * @param $fd[required]
     * @return mixed
     */
    public function offsetGet($fd){}

    /**
     * @param $fd[required]
     * @param $value[required]
     * @return mixed
     */
    public function offsetSet($fd, $value){}

    /**
     * @param $fd[required]
     * @return mixed
     */
    public function offsetUnset($fd){}


}
