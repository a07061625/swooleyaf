<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getLockReason()
 * @method $this withLockReason($value)
 * @method string getScope()
 * @method $this withScope($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method array getTag()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getInstanceTypeFamily()
 * @method $this withInstanceTypeFamily($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getReservedInstanceId()
 * @method string getOfferingType()
 * @method $this withOfferingType($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getReservedInstanceName()
 * @method $this withReservedInstanceName($value)
 * @method array getStatus()
 * @method string getAllocationType()
 * @method $this withAllocationType($value)
 */
class DescribeReservedInstances extends Rpc
{
    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withReservedInstanceId(array $reservedInstanceId)
    {
        $this->data['ReservedInstanceId'] = $reservedInstanceId;
        foreach ($reservedInstanceId as $i => $iValue) {
            $this->options['query']['ReservedInstanceId.' . ($i + 1)] = $iValue;
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
