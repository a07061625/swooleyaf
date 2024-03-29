<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Core\OssUtil;
use SyObjectStorage\Oss\Model\ObjectInfo;
use SyObjectStorage\Oss\Model\ObjectListInfo;
use SyObjectStorage\Oss\Model\PrefixInfo;

/**
 * Class ListObjectsResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class ListObjectsResult extends Result
{
    /**
     * Parse the xml data returned by the ListObjects interface
     * return ObjectListInfo
     *
     * @throws \Exception
     */
    protected function parseDataFromResponse()
    {
        $xml = new \SimpleXMLElement($this->rawResponse->body);
        $encodingType = isset($xml->EncodingType) ? (string)($xml->EncodingType) : '';
        $objectList = $this->parseObjectList($xml, $encodingType);
        $prefixList = $this->parsePrefixList($xml, $encodingType);
        $bucketName = isset($xml->Name) ? (string)($xml->Name) : '';
        $prefix = isset($xml->Prefix) ? (string)($xml->Prefix) : '';
        $prefix = OssUtil::decodeKey($prefix, $encodingType);
        $marker = isset($xml->Marker) ? (string)($xml->Marker) : '';
        $marker = OssUtil::decodeKey($marker, $encodingType);
        $maxKeys = isset($xml->MaxKeys) ? (int)($xml->MaxKeys) : 0;
        $delimiter = isset($xml->Delimiter) ? (string)($xml->Delimiter) : '';
        $delimiter = OssUtil::decodeKey($delimiter, $encodingType);
        $isTruncated = isset($xml->IsTruncated) ? (string)($xml->IsTruncated) : '';
        $nextMarker = isset($xml->NextMarker) ? (string)($xml->NextMarker) : '';
        $nextMarker = OssUtil::decodeKey($nextMarker, $encodingType);

        return new ObjectListInfo($bucketName, $prefix, $marker, $nextMarker, $maxKeys, $delimiter, $isTruncated, $objectList, $prefixList);
    }

    private function parseObjectList($xml, $encodingType)
    {
        $retList = [];
        if (isset($xml->Contents)) {
            foreach ($xml->Contents as $content) {
                $key = isset($content->Key) ? (string)($content->Key) : '';
                $key = OssUtil::decodeKey($key, $encodingType);
                $lastModified = isset($content->LastModified) ? (string)($content->LastModified) : '';
                $eTag = isset($content->ETag) ? (string)($content->ETag) : '';
                $type = isset($content->Type) ? (string)($content->Type) : '';
                $size = isset($content->Size) ? (int)($content->Size) : 0;
                $storageClass = isset($content->StorageClass) ? (string)($content->StorageClass) : '';
                $retList[] = new ObjectInfo($key, $lastModified, $eTag, $type, $size, $storageClass);
            }
        }

        return $retList;
    }

    private function parsePrefixList($xml, $encodingType)
    {
        $retList = [];
        if (isset($xml->CommonPrefixes)) {
            foreach ($xml->CommonPrefixes as $commonPrefix) {
                $prefix = isset($commonPrefix->Prefix) ? (string)($commonPrefix->Prefix) : '';
                $prefix = OssUtil::decodeKey($prefix, $encodingType);
                $retList[] = new PrefixInfo($prefix);
            }
        }

        return $retList;
    }
}
