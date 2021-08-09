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
     * BucketListInfo constructor.
     * @param array $bucketList
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

    /**
     * BucketInfo list
     *
     * @var array
     */
    private $bucketList = array();
}