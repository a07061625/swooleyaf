<?php
namespace AliOss\Model;

class BucketListInfo {
    /**
     * BucketInfo list
     * @var array
     */
    private $bucketList = [];

    /**
     * BucketListInfo constructor.
     * @param array $bucketList
     */
    public function __construct(array $bucketList){
        $this->bucketList = $bucketList;
    }

    /**
     * Get the BucketInfo list
     * @return BucketInfo[]
     */
    public function getBucketList(){
        return $this->bucketList;
    }
}