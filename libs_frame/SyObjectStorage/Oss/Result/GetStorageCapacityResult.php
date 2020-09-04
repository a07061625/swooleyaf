<?php
namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class AclResult  GetBucketAcl interface returns the result class, encapsulated
 * The returned xml data is parsed
 * @package SyObjectStorage\Oss\Result
 */
class GetStorageCapacityResult extends Result
{
    /**
     * Parse data from response
     * @return string
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        if (empty($content)) {
            throw new OssException("body is null");
        }
        $xml = simplexml_load_string($content);
        if (isset($xml->StorageCapacity)) {
            return intval($xml->StorageCapacity);
        } else {
            throw new OssException("xml format exception");
        }
    }
}