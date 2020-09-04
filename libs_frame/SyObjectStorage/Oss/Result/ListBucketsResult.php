<?php
namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\BucketInfo;
use SyObjectStorage\Oss\Model\BucketListInfo;

/**
 * Class ListBucketsResult
 * @package SyObjectStorage\Oss\Result
 */
class ListBucketsResult extends Result
{
    /**
     * @return \SyObjectStorage\Oss\Model\BucketListInfo
     */
    protected function parseDataFromResponse()
    {
        $bucketList = [];
        $content = $this->rawResponse->body;
        $xml = new \SimpleXMLElement($content);
        if (isset($xml->Buckets) && isset($xml->Buckets->Bucket)) {
            foreach ($xml->Buckets->Bucket as $bucket) {
                $bucketInfo = new BucketInfo(strval($bucket->Location), strval($bucket->Name), strval($bucket->CreationDate));
                $bucketList[] = $bucketInfo;
            }
        }

        return new BucketListInfo($bucketList);
    }
}