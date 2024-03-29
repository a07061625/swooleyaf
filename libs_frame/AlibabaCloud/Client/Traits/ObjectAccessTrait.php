<?php

namespace AlibabaCloud\Client\Traits;

/**
 * Trait ObjectAccessTrait
 *
 * @package   AlibabaCloud\Client\Traits
 */
trait ObjectAccessTrait
{
    /**
     * @param string $name
     *
     * @return null|mixed
     */
    public function __get($name)
    {
        if (!isset($this->data[$name])) {
            return;
        }

        return json_decode(json_encode($this->data))->{$name};
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * @param $name
     */
    public function __unset($name)
    {
        unset($this->data[$name]);
    }
}
