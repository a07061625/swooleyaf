<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Class ObjectListInfo
 *
 * The class of return value of ListObjects
 *
 * @package SyObjectStorage\Oss\Model
 *
 * @see http://help.aliyun.com/document_detail/oss/api-reference/bucket/GetBucket.html
 */
class ObjectListInfo
{
    private $bucketName = '';
    private $prefix = '';
    private $marker = '';
    private $nextMarker = '';
    private $maxKeys = 0;
    private $delimiter = '';
    private $isTruncated;
    private $objectList = [];
    private $prefixList = [];

    /**
     * ObjectListInfo constructor.
     *
     * @param string $bucketName
     * @param string $prefix
     * @param string $marker
     * @param string $nextMarker
     * @param string $maxKeys
     * @param string $delimiter
     * @param null   $isTruncated
     */
    public function __construct($bucketName, $prefix, $marker, $nextMarker, $maxKeys, $delimiter, $isTruncated, array $objectList, array $prefixList)
    {
        $this->bucketName = $bucketName;
        $this->prefix = $prefix;
        $this->marker = $marker;
        $this->nextMarker = $nextMarker;
        $this->maxKeys = $maxKeys;
        $this->delimiter = $delimiter;
        $this->isTruncated = $isTruncated;
        $this->objectList = $objectList;
        $this->prefixList = $prefixList;
    }

    /**
     * @return string
     */
    public function getBucketName()
    {
        return $this->bucketName;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @return string
     */
    public function getMarker()
    {
        return $this->marker;
    }

    /**
     * @return int
     */
    public function getMaxKeys()
    {
        return $this->maxKeys;
    }

    /**
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * @return mixed
     */
    public function getIsTruncated()
    {
        return $this->isTruncated;
    }

    /**
     * Get the ObjectInfo list.
     *
     * @return ObjectInfo[]
     */
    public function getObjectList()
    {
        return $this->objectList;
    }

    /**
     * Get the PrefixInfo list
     *
     * @return PrefixInfo[]
     */
    public function getPrefixList()
    {
        return $this->prefixList;
    }

    /**
     * @return string
     */
    public function getNextMarker()
    {
        return $this->nextMarker;
    }
}
