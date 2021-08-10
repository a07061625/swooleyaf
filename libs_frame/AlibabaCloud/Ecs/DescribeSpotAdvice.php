<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getGpuSpec()
 * @method $this withGpuSpec($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getMemory()
 * @method $this withMemory($value)
 * @method array getInstanceTypes()
 * @method string getIoOptimized()
 * @method $this withIoOptimized($value)
 * @method string getMinCores()
 * @method $this withMinCores($value)
 * @method string getNetworkType()
 * @method $this withNetworkType($value)
 * @method string getCores()
 * @method $this withCores($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getInstanceTypeFamily()
 * @method $this withInstanceTypeFamily($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInstanceFamilyLevel()
 * @method $this withInstanceFamilyLevel($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getGpuAmount()
 * @method $this withGpuAmount($value)
 * @method string getMinMemory()
 * @method $this withMinMemory($value)
 */
class DescribeSpotAdvice extends Rpc
{
    /**
     * @return $this
     */
    public function withInstanceTypes(array $instanceTypes)
    {
        $this->data['InstanceTypes'] = $instanceTypes;
        foreach ($instanceTypes as $i => $iValue) {
            $this->options['query']['InstanceTypes.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
