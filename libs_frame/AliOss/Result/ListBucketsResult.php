<?php
namespace AliOss\Result;

use AliOss\Model\BucketInfo;
use AliOss\Model\BucketListInfo;

class ListBucketsResult extends Result {
    /**
     * @return BucketListInfo
     */
    protected function parseDataFromResponse(){
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