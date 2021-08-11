<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPlatform()
 * @method $this withPlatform($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPrivatePoolOptionsMatchCriteria()
 * @method array getInstanceType()
 * @method array getTag()
 * @method string getInstanceChargeType()
 * @method $this withInstanceChargeType($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getPrivatePoolOptionsName()
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getAssuranceTimes()
 * @method $this withAssuranceTimes($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 * @method string getInstanceCpuCoreCount()
 * @method $this withInstanceCpuCoreCount($value)
 * @method string getPeriodUnit()
 * @method $this withPeriodUnit($value)
 * @method array getZoneId()
 * @method string getChargeType()
 * @method $this withChargeType($value)
 * @method string getPackageType()
 * @method $this withPackageType($value)
 * @method string getInstanceAmount()
 * @method $this withInstanceAmount($value)
 */
class CreateElasticityAssurance extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPrivatePoolOptionsMatchCriteria($value)
    {
        $this->data['PrivatePoolOptionsMatchCriteria'] = $value;
        $this->options['query']['PrivatePoolOptions.MatchCriteria'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withInstanceType(array $instanceType)
    {
        $this->data['InstanceType'] = $instanceType;
        foreach ($instanceType as $i => $iValue) {
            $this->options['query']['InstanceType.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

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
     * @param string $value
     *
     * @return $this
     */
    public function withPrivatePoolOptionsName($value)
    {
        $this->data['PrivatePoolOptionsName'] = $value;
        $this->options['query']['PrivatePoolOptions.Name'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withZoneId(array $zoneId)
    {
        $this->data['ZoneId'] = $zoneId;
        foreach ($zoneId as $i => $iValue) {
            $this->options['query']['ZoneId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
