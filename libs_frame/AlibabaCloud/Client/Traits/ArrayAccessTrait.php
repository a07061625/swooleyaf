<?php

namespace AlibabaCloud\Client\Traits;

/**
 * Trait ArrayAccessTrait
 *
 * @package   AlibabaCloud\Client\Traits
 */
trait ArrayAccessTrait
{
    /**
     * This method returns a reference to the variable to allow for indirect
     * array modification (e.g., $foo['bar']['baz'] = 'qux').
     *
     * @param string $offset
     *
     * @return null|mixed
     */
    public function &offsetGet($offset)
    {
        if (isset($this->data[$offset])) {
            return $this->data[$offset];
        }

        return null;
    }

    /**
     * @param string       $offset
     * @param mixed|string $value
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * @param string $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param string $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}
