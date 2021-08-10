<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getCapacity()
 * @method $this withCapacity($value)
 * @method array getStorageCapacityUnitId()
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method array getStatus()
 * @method string getAllocationType()
 * @method $this withAllocationType($value)
 */
class DescribeStorageCapacityUnits extends Rpc
{
    /**
     * @return $this
     */
    public function withStorageCapacityUnitId(array $storageCapacityUnitId)
    {
        $this->data['StorageCapacityUnitId'] = $storageCapacityUnitId;
        foreach ($storageCapacityUnitId as $i => $iValue) {
            $this->options['query']['StorageCapacityUnitId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withStatus(array $status)
    {
        $this->data['Status'] = $status;
        foreach ($status as $i => $iValue) {
            $this->options['query']['Status.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
