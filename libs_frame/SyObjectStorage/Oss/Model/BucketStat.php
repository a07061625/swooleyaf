<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Bucket stat class.
 *
 * Class BucketStat
 *
 * @package SyObjectStorage\Oss\Model
 */
class BucketStat
{
    /**
     * current storage
     *
     * @var int
     */
    private $storage;
    /**
     * object count
     *
     * @var int
     */
    private $objectCount;

    /**
     * multipart upload count
     *
     * @var int
     */
    private $multipartUploadCount;

    /**
     * Get storage
     *
     * @return int
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * Get object count
     *
     * @return int
     */
    public function getObjectCount()
    {
        return $this->objectCount;
    }

    /**
     * Get multipart upload count.
     *
     * @return int
     */
    public function getMultipartUploadCount()
    {
        return $this->multipartUploadCount;
    }

    /**
     * Parse stat from the xml.
     *
     * @param string $strXml
     *
     * @throws OssException
     */
    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        if (isset($xml->Storage)) {
            $this->storage = (int)($xml->Storage);
        }
        if (isset($xml->ObjectCount)) {
            $this->objectCount = (int)($xml->ObjectCount);
        }
        if (isset($xml->MultipartUploadCount)) {
            $this->multipartUploadCount = (int)($xml->MultipartUploadCount);
        }
    }
}
