<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\ListPartsInfo;
use SyObjectStorage\Oss\Model\PartInfo;

/**
 * Class ListPartsResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class ListPartsResult extends Result
{
    /**
     * Parse the xml data returned by the ListParts interface
     *
     * @return ListPartsInfo
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $xml = simplexml_load_string($content);
        $bucket = isset($xml->Bucket) ? (string)($xml->Bucket) : '';
        $key = isset($xml->Key) ? (string)($xml->Key) : '';
        $uploadId = isset($xml->UploadId) ? (string)($xml->UploadId) : '';
        $nextPartNumberMarker = isset($xml->NextPartNumberMarker) ? (int)($xml->NextPartNumberMarker) : '';
        $maxParts = isset($xml->MaxParts) ? (int)($xml->MaxParts) : '';
        $isTruncated = isset($xml->IsTruncated) ? (string)($xml->IsTruncated) : '';
        $partList = [];
        if (isset($xml->Part)) {
            foreach ($xml->Part as $part) {
                $partNumber = isset($part->PartNumber) ? (int)($part->PartNumber) : '';
                $lastModified = isset($part->LastModified) ? (string)($part->LastModified) : '';
                $eTag = isset($part->ETag) ? (string)($part->ETag) : '';
                $size = isset($part->Size) ? (int)($part->Size) : '';
                $partList[] = new PartInfo($partNumber, $lastModified, $eTag, $size);
            }
        }

        return new ListPartsInfo($bucket, $key, $uploadId, $nextPartNumberMarker, $maxParts, $isTruncated, $partList);
    }
}
