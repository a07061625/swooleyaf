<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Class DeleteObjectInfo
 *
 * @package SyObjectStorage\Oss\Model
 */
class DeleteObjectInfo
{
    private $key = '';
    private $versionId = '';

    /**
     * DeleteObjectInfo constructor.
     *
     * @param string $key
     * @param string $versionId
     */
    public function __construct($key, $versionId = '')
    {
        $this->key = $key;
        $this->versionId = $versionId;
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
    public function getVersionId()
    {
        return $this->versionId;
    }
}
