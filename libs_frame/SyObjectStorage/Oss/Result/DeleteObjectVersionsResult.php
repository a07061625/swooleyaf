<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Core\OssUtil;
use SyObjectStorage\Oss\Model\DeletedObjectInfo;

/**
 * Class DeleteObjectVersionsResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class DeleteObjectVersionsResult extends Result
{
    /**
     * @return DeletedObjectInfo[]
     */
    protected function parseDataFromResponse()
    {
        $xml = simplexml_load_string($this->rawResponse->body);
        $encodingType = isset($xml->EncodingType) ? (string)($xml->EncodingType) : '';

        return $this->parseDeletedList($xml, $encodingType);
    }

    private function parseDeletedList($xml, $encodingType)
    {
        $retList = [];
        if (isset($xml->Deleted)) {
            foreach ($xml->Deleted as $content) {
                $key = isset($content->Key) ? (string)($content->Key) : '';
                $key = OssUtil::decodeKey($key, $encodingType);
                $versionId = isset($content->VersionId) ? (string)($content->VersionId) : '';
                $deleteMarker = isset($content->DeleteMarker) ? (string)($content->DeleteMarker) : '';
                $deleteMarkerVersionId = isset($content->DeleteMarkerVersionId) ? (string)($content->DeleteMarkerVersionId) : '';
                $retList[] = new DeletedObjectInfo($key, $versionId, $deleteMarker, $deleteMarkerVersionId);
            }
        }

        return $retList;
    }
}
