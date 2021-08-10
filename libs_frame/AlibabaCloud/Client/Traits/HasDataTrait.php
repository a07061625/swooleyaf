<?php

namespace AlibabaCloud\Client\Traits;

use Adbar\Dot;
use AlibabaCloud\Client\Result\Result;
use ArrayIterator;
use JmesPath\Env as JmesPath;

/**
 * Trait HasDataTrait
 *
 * @package   AlibabaCloud\Client\Traits
 * @mixin     Result
 */
trait HasDataTrait
{
    /**
     * Instance of the Dot.
     *
     * @var Dot
     */
    protected $dot;

    /**
     * @param string $name
     *
     * @return null|mixed
     */
    public function __get($name)
    {
        if (!isset($this->all()[$name])) {
            return;
        }

        return json_decode(json_encode($this->all()))->{$name};
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $this->add($name, $value);
    }

    /*
     * --------------------------------------------------------------
     * ObjectAccess
     * --------------------------------------------------------------
     */

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return $this->has($name);
    }

    /**
     * @param $name
     */
    public function __unset($name)
    {
        $this->delete($name);
    }

    /**
     * @param string $expression
     *
     * @return null|mixed
     */
    public function search($expression)
    {
        return JmesPath::search($expression, $this->dot->all());
    }

    /**
     * Delete the contents of a given key or keys
     *
     * @param null|array|int|string $keys
     */
    public function clear($keys = null)
    {
        $this->dot->clear($keys);
    }

    /**
     * Flatten an array with the given character as a key delimiter
     *
     * @param string     $delimiter
     * @param null|array $items
     * @param string     $prepend
     *
     * @return array
     */
    public function flatten($delimiter = '.', $items = null, $prepend = '')
    {
        return $this->dot->flatten($delimiter, $items, $prepend);
    }

    /**
     * Return the value of a given key
     *
     * @param null|int|string $key
     * @param mixed           $default
     *
     * @return mixed
     */
    public function get($key = null, $default = null)
    {
        return $this->dot->get($key, $default);
    }

    /**
     * Set a given key / value pair or pairs
     *
     * @param array|int|string $keys
     * @param mixed            $value
     */
    public function set($keys, $value = null)
    {
        $this->dot->set($keys, $value);
    }

    /**
     * Check if a given key or keys are empty
     *
     * @param null|array|int|string $keys
     *
     * @return bool
     */
    public function isEmpty($keys = null)
    {
        return $this->dot->isEmpty($keys);
    }

    /**
     * Replace all items with a given array as a reference
     */
    public function setReference(array &$items)
    {
        $this->dot->setReference($items);
    }

    /**
     * Return the value of a given key or all the values as JSON
     *
     * @param mixed $key
     * @param int   $options
     *
     * @return string
     */
    public function toJson($key = null, $options = 0)
    {
        return $this->dot->toJson($key, $options);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->dot->all();
    }

    /**
     * Check if a given key exists
     *
     * @param int|string $key
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->dot->has($key);
    }

    /**
     * Return the value of a given key
     *
     * @param int|string $key
     *
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->dot->offsetGet($key);
    }

    /**
     * Set a given value to the given key
     *
     * @param null|int|string $key
     * @param mixed           $value
     */
    public function offsetSet($key, $value)
    {
        $this->dot->offsetSet($key, $value);
    }

    /**
     * Delete the given key
     *
     * @param int|string $key
     */
    public function offsetUnset($key)
    {
        $this->delete($key);
    }

    /**
     * Delete the given key or keys
     *
     * @param array|int|string $keys
     */
    public function delete($keys)
    {
        $this->dot->delete($keys);
    }

    /*
     * --------------------------------------------------------------
     * ArrayAccess interface
     * --------------------------------------------------------------
     */

    /**
     * Return the number of items in a given key
     *
     * @param null|int|string $key
     *
     * @return int
     */
    public function count($key = null)
    {
        return $this->dot->count($key);
    }

    /**
     * Get an iterator for the stored items
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return $this->dot->getIterator();
    }

    /**
     * Return items for JSON serialization
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->dot->jsonSerialize();
    }

    /*
     * --------------------------------------------------------------
     * Countable interface
     * --------------------------------------------------------------
     */

    /**
     * Return all the stored items
     *
     * @return array
     */
    public function all()
    {
        return $this->dot->all();
    }

    /**
     * Set a given key / value pair or pairs
     * if the key doesn't exist already
     *
     * @param array|int|string $keys
     * @param mixed            $value
     */
    public function add($keys, $value = null)
    {
        $this->dot->add($keys, $value);
    }

    /**
     * Check if a given key or keys exists
     *
     * @param array|int|string $keys
     *
     * @return bool
     */
    public function has($keys)
    {
        return $this->dot->has($keys);
    }

    protected function dot(array $data = [])
    {
        $this->dot = new Dot($data);
    }
}
