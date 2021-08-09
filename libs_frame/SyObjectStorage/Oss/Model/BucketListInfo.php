<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Class BucketListInfo
 *
 * It's the type of return value of ListBuckets.
 *
 * @package SyObjectStorage\Oss\Model
 */
class BucketListInfo
{
    /**
     * BucketInfo list
     *
     * @var array
     */
    private $bucketList = [];

    /**
     * BucketListInfo constructor.
     */
    public function __construct(array $bucketList)
    {
        $this->bucketList = $bucketList;
    }

    /**
     * Get the BucketInfo list
     *
     * @return BucketInfo[]
     */
    public function getBucketList()
    {
        return $this->bucketList;
    }
}
