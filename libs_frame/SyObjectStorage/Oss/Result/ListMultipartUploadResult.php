<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Core\OssUtil;
use SyObjectStorage\Oss\Model\ListMultipartUploadInfo;
use SyObjectStorage\Oss\Model\UploadInfo;

/**
 * Class ListMultipartUploadResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class ListMultipartUploadResult extends Result
{
    /**
     * Parse the return data from the ListMultipartUpload interface
     *
     * @return ListMultipartUploadInfo
     *
     * @throws \SyObjectStorage\Oss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $xml = simplexml_load_string($content);

        $encodingType = isset($xml->EncodingType) ? (string)($xml->EncodingType) : '';
        $bucket = isset($xml->Bucket) ? (string)($xml->Bucket) : '';
        $keyMarker = isset($xml->KeyMarker) ? (string)($xml->KeyMarker) : '';
        $keyMarker = OssUtil::decodeKey($keyMarker, $encodingType);
        $uploadIdMarker = isset($xml->UploadIdMarker) ? (string)($xml->UploadIdMarker) : '';
        $nextKeyMarker = isset($xml->NextKeyMarker) ? (string)($xml->NextKeyMarker) : '';
        $nextKeyMarker = OssUtil::decodeKey($nextKeyMarker, $encodingType);
        $nextUploadIdMarker = isset($xml->NextUploadIdMarker) ? (string)($xml->NextUploadIdMarker) : '';
        $delimiter = isset($xml->Delimiter) ? (string)($xml->Delimiter) : '';
        $delimiter = OssUtil::decodeKey($delimiter, $encodingType);
        $prefix = isset($xml->Prefix) ? (string)($xml->Prefix) : '';
        $prefix = OssUtil::decodeKey($prefix, $encodingType);
        $maxUploads = isset($xml->MaxUploads) ? (int)($xml->MaxUploads) : 0;
        $isTruncated = isset($xml->IsTruncated) ? (string)($xml->IsTruncated) : '';
        $listUpload = [];

        if (isset($xml->Upload)) {
            foreach ($xml->Upload as $upload) {
                $key = isset($upload->Key) ? (string)($upload->Key) : '';
                $key = OssUtil::decodeKey($key, $encodingType);
                $uploadId = isset($upload->UploadId) ? (string)($upload->UploadId) : '';
                $initiated = isset($upload->Initiated) ? (string)($upload->Initiated) : '';
                $listUpload[] = new UploadInfo($key, $uploadId, $initiated);
            }
        }

        return new ListMultipartUploadInfo(
            $bucket,
            $keyMarker,
            $uploadIdMarker,
            $nextKeyMarker,
            $nextUploadIdMarker,
            $delimiter,
            $prefix,
            $maxUploads,
            $isTruncated,
            $listUpload
        );
    }
}
