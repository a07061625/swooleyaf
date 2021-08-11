<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method array getDedicatedBlockStorageClusterId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 * @method string getCategory()
 * @method $this withCategory($value)
 * @method array getStatus()
 */
class DescribeDedicatedBlockStorageClusters extends Rpc
{
    /**
     * @return $this
     */
    public function withDedicatedBlockStorageClusterId(array $dedicatedBlockStorageClusterId)
    {
        $this->data['DedicatedBlockStorageClusterId'] = $dedicatedBlockStorageClusterId;
        foreach ($dedicatedBlockStorageClusterId as $i => $iValue) {
            $this->options['query']['DedicatedBlockStorageClusterId.' . ($i + 1)] = $iValue;
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
