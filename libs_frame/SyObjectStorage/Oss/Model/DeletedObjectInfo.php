<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Class DeletedObjectInfo
 *
 * @package SyObjectStorage\Oss\Model
 */
class DeletedObjectInfo
{
    private $key = '';
    private $versionId = '';
    private $deleteMarker = '';
    private $deleteMarkerVersionId = '';

    /**
     * DeletedObjectInfo constructor.
     *
     * @param string $key
     * @param string $versionId
     * @param string $deleteMarker
     * @param string $deleteMarkerVersionId
     */
    public function __construct($key, $versionId, $deleteMarker, $deleteMarkerVersionId)
    {
        $this->key = $key;
        $this->versionId = $versionId;
        $this->deleteMarker = $deleteMarker;
        $this->deleteMarkerVersionId = $deleteMarkerVersionId;
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

    /**
     * @return string
     */
    public function getDeleteMarker()
    {
        return $this->deleteMarker;
    }

    /**
     * @return string
     */
    public function getDeleteMarkerVersionId()
    {
        return $this->deleteMarkerVersionId;
    }
}
