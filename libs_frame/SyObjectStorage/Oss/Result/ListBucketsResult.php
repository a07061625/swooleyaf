<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\BucketInfo;
use SyObjectStorage\Oss\Model\BucketListInfo;

/**
 * Class ListBucketsResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class ListBucketsResult extends Result
{
    /**
     * @return BucketListInfo
     *
     * @throws \Exception
     */
    protected function parseDataFromResponse()
    {
        $bucketList = [];
        $content = $this->rawResponse->body;
        $xml = new \SimpleXMLElement($content);
        if (isset($xml->Buckets, $xml->Buckets->Bucket)) {
            foreach ($xml->Buckets->Bucket as $bucket) {
                $bucketInfo = new BucketInfo();
                $bucketInfo->parseFromXmlNode($bucket);
                $bucketList[] = $bucketInfo;
            }
        }

        return new BucketListInfo($bucketList);
    }
}
