<?php
namespace Swoole\Table;

/**
 * @since 4.2.12
 */
class Row
{


    /**
     * @param $offset[required]
     * @return mixed
     */
    public function offsetExists($offset){}

    /**
     * @param $offset[required]
     * @return mixed
     */
    public function offsetGet($offset){}

    /**
     * @param $offset[required]
     * @param $value[required]
     * @return mixed
     */
    public function offsetSet($offset, $value){}

    /**
     * @param $offset[required]
     * @return mixed
     */
    public function offsetUnset($offset){}

    /**
     * @return mixed
     */
    public function __destruct(){}


}
