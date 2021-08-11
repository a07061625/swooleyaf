<?php

namespace AlibabaCloud\EHPC;

/**
 * @method string getImageId()
 * @method $this withImageId($value)
 * @method string getMemory()
 * @method $this withMemory($value)
 * @method string getSystemDiskLevel()
 * @method $this withSystemDiskLevel($value)
 * @method string getAllocatePublicAddress()
 * @method $this withAllocatePublicAddress($value)
 * @method string getInternetMaxBandWidthOut()
 * @method $this withInternetMaxBandWidthOut($value)
 * @method string getResourceAmountType()
 * @method $this withResourceAmountType($value)
 * @method string getStrictResourceProvision()
 * @method $this withStrictResourceProvision($value)
 * @method string getSystemDiskType()
 * @method $this withSystemDiskType($value)
 * @method string getCores()
 * @method $this withCores($value)
 * @method string getSystemDiskSize()
 * @method $this withSystemDiskSize($value)
 * @method array getZoneInfos()
 * @method string getHostNamePrefix()
 * @method $this withHostNamePrefix($value)
 * @method string getComputeSpotPriceLimit()
 * @method $this withComputeSpotPriceLimit($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getComputeSpotStrategy()
 * @method $this withComputeSpotStrategy($value)
 * @method string getHostNameSuffix()
 * @method $this withHostNameSuffix($value)
 * @method string getPriorityStrategy()
 * @method $this withPriorityStrategy($value)
 * @method string getInstanceFamilyLevel()
 * @method $this withInstanceFamilyLevel($value)
 * @method string getInternetChargeType()
 * @method $this withInternetChargeType($value)
 * @method array getInstanceTypeModel()
 * @method string getInternetMaxBandWidthIn()
 * @method $this withInternetMaxBandWidthIn($value)
 * @method string getTargetCapacity()
 * @method $this withTargetCapacity($value)
 * @method string getStrictSatisfiedTargetCapacity()
 * @method $this withStrictSatisfiedTargetCapacity($value)
 */
class ApplyNodes extends Rpc
{
    /**
     * @return $this
     */
    public function withZoneInfos(array $zoneInfos)
    {
        $this->data['ZoneInfos'] = $zoneInfos;
        foreach ($zoneInfos as $depth1 => $depth1Value) {
            if (isset($depth1Value['VSwitchId'])) {
                $this->options['query']['ZoneInfos.' . ($depth1 + 1) . '.VSwitchId'] = $depth1Value['VSwitchId'];
            }
            if (isset($depth1Value['ZoneId'])) {
                $this->options['query']['ZoneInfos.' . ($depth1 + 1) . '.ZoneId'] = $depth1Value['ZoneId'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withInstanceTypeModel(array $instanceTypeModel)
    {
        $this->data['InstanceTypeModel'] = $instanceTypeModel;
        foreach ($instanceTypeModel as $depth1 => $depth1Value) {
            if (isset($depth1Value['MaxPrice'])) {
                $this->options['query']['InstanceTypeModel.' . ($depth1 + 1) . '.MaxPrice'] = $depth1Value['MaxPrice'];
            }
            if (isset($depth1Value['TargetImageId'])) {
                $this->options['query']['InstanceTypeModel.' . ($depth1 + 1) . '.TargetImageId'] = $depth1Value['TargetImageId'];
            }
            if (isset($depth1Value['InstanceType'])) {
                $this->options['query']['InstanceTypeModel.' . ($depth1 + 1) . '.InstanceType'] = $depth1Value['InstanceType'];
            }
        }

        return $this;
    }
}
