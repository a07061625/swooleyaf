<?php
namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Core\OssUtil;
use SyObjectStorage\Oss\Model\ListMultipartUploadInfo;
use SyObjectStorage\Oss\Model\UploadInfo;

/**
 * Class ListMultipartUploadResult
 * @package SyObjectStorage\Oss\Result
 */
class ListMultipartUploadResult extends Result
{
    /**
     * Parse the return data from the ListMultipartUpload interface
     * @return \SyObjectStorage\Oss\Model\ListMultipartUploadInfo
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $xml = simplexml_load_string($content);

        $encodingType = isset($xml->EncodingType) ? strval($xml->EncodingType) : "";
        $bucket = isset($xml->Bucket) ? strval($xml->Bucket) : "";
        $keyMarker = isset($xml->KeyMarker) ? strval($xml->KeyMarker) : "";
        $keyMarker = OssUtil::decodeKey($keyMarker, $encodingType);
        $uploadIdMarker = isset($xml->UploadIdMarker) ? strval($xml->UploadIdMarker) : "";
        $nextKeyMarker = isset($xml->NextKeyMarker) ? strval($xml->NextKeyMarker) : "";
        $nextKeyMarker = OssUtil::decodeKey($nextKeyMarker, $encodingType);
        $nextUploadIdMarker = isset($xml->NextUploadIdMarker) ? strval($xml->NextUploadIdMarker) : "";
        $delimiter = isset($xml->Delimiter) ? strval($xml->Delimiter) : "";
        $delimiter = OssUtil::decodeKey($delimiter, $encodingType);
        $prefix = isset($xml->Prefix) ? strval($xml->Prefix) : "";
        $prefix = OssUtil::decodeKey($prefix, $encodingType);
        $maxUploads = isset($xml->MaxUploads) ? intval($xml->MaxUploads) : 0;
        $isTruncated = isset($xml->IsTruncated) ? strval($xml->IsTruncated) : "";
        $listUpload = [];

        if (isset($xml->Upload)) {
            foreach ($xml->Upload as $upload) {
                $key = isset($upload->Key) ? strval($upload->Key) : "";
                $key = OssUtil::decodeKey($key, $encodingType);
                $uploadId = isset($upload->UploadId) ? strval($upload->UploadId) : "";
                $initiated = isset($upload->Initiated) ? strval($upload->Initiated) : "";
                $listUpload[] = new UploadInfo($key, $uploadId, $initiated);
            }
        }

        return new ListMultipartUploadInfo($bucket, $keyMarker, $uploadIdMarker, $nextKeyMarker, $nextUploadIdMarker, $delimiter, $prefix,
            $maxUploads, $isTruncated, $listUpload);
    }
}