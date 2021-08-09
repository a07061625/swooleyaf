<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Core\OssUtil;
use SyObjectStorage\Oss\Model\DeleteMarkerInfo;
use SyObjectStorage\Oss\Model\ObjectVersionInfo;
use SyObjectStorage\Oss\Model\ObjectVersionListInfo;
use SyObjectStorage\Oss\Model\PrefixInfo;

/**
 * Class ListObjectVersionsResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class ListObjectVersionsResult extends Result
{
    /**
     * Parse the xml data returned by the ListObjectVersions interface
     * return ObjectVersionListInfo
     */
    protected function parseDataFromResponse()
    {
        $xml = simplexml_load_string($this->rawResponse->body);
        $encodingType = isset($xml->EncodingType) ? (string)($xml->EncodingType) : '';
        $objectVersionList = $this->parseObjecVersionList($xml, $encodingType);
        $deleteMarkerList = $this->parseDeleteMarkerList($xml, $encodingType);
        $prefixList = $this->parsePrefixList($xml, $encodingType);
        $bucketName = isset($xml->Name) ? (string)($xml->Name) : '';
        $prefix = isset($xml->Prefix) ? (string)($xml->Prefix) : '';
        $prefix = OssUtil::decodeKey($prefix, $encodingType);
        $keyMarker = isset($xml->KeyMarker) ? (string)($xml->KeyMarker) : '';
        $keyMarker = OssUtil::decodeKey($keyMarker, $encodingType);
        $nextKeyMarker = isset($xml->NextKeyMarker) ? (string)($xml->NextKeyMarker) : '';
        $nextKeyMarker = OssUtil::decodeKey($nextKeyMarker, $encodingType);
        $versionIdMarker = isset($xml->VersionIdMarker) ? (string)($xml->VersionIdMarker) : '';
        $nextVersionIdMarker = isset($xml->NextVersionIdMarker) ? (string)($xml->NextVersionIdMarker) : '';
        $maxKeys = isset($xml->MaxKeys) ? (int)($xml->MaxKeys) : 0;
        $delimiter = isset($xml->Delimiter) ? (string)($xml->Delimiter) : '';
        $delimiter = OssUtil::decodeKey($delimiter, $encodingType);
        $isTruncated = isset($xml->IsTruncated) ? (string)($xml->IsTruncated) : '';

        return new ObjectVersionListInfo(
            $bucketName,
            $prefix,
            $keyMarker,
            $nextKeyMarker,
            $versionIdMarker,
            $nextVersionIdMarker,
            $maxKeys,
            $delimiter,
            $isTruncated,
            $objectVersionList,
            $deleteMarkerList,
            $prefixList
        );
    }

    private function parseObjecVersionList($xml, $encodingType)
    {
        $retList = [];
        if (isset($xml->Version)) {
            foreach ($xml->Version as $content) {
                $key = isset($content->Key) ? (string)($content->Key) : '';
                $key = OssUtil::decodeKey($key, $encodingType);
                $versionId = isset($content->VersionId) ? (string)($content->VersionId) : '';
                $lastModified = isset($content->LastModified) ? (string)($content->LastModified) : '';
                $eTag = isset($content->ETag) ? (string)($content->ETag) : '';
                $type = isset($content->Type) ? (string)($content->Type) : '';
                $size = isset($content->Size) ? (int)($content->Size) : 0;
                $storageClass = isset($content->StorageClass) ? (string)($content->StorageClass) : '';
                $isLatest = isset($content->IsLatest) ? (string)($content->IsLatest) : '';
                $retList[] = new ObjectVersionInfo($key, $versionId, $lastModified, $eTag, $type, $size, $storageClass, $isLatest);
            }
        }

        return $retList;
    }

    private function parseDeleteMarkerList($xml, $encodingType)
    {
        $retList = [];
        if (isset($xml->DeleteMarker)) {
            foreach ($xml->DeleteMarker as $content) {
                $key = isset($content->Key) ? (string)($content->Key) : '';
                $key = OssUtil::decodeKey($key, $encodingType);
                $versionId = isset($content->VersionId) ? (string)($content->VersionId) : '';
                $lastModified = isset($content->LastModified) ? (string)($content->LastModified) : '';
                $isLatest = isset($content->IsLatest) ? (string)($content->IsLatest) : '';
                $retList[] = new DeleteMarkerInfo($key, $versionId, $lastModified, $isLatest);
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
