<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Class Tag
 *
 * @package SyObjectStorage\Oss\Model
 */
class Tag
{
    private $key = '';
    private $value = '';

    /**
     * Tag constructor.
     *
     * @param string $key
     * @param string $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
