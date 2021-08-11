<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getCpuOverCommitRatio()
 * @method $this withCpuOverCommitRatio($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getMinQuantity()
 * @method $this withMinQuantity($value)
 * @method string getActionOnMaintenance()
 * @method $this withActionOnMaintenance($value)
 * @method string getDedicatedHostClusterId()
 * @method $this withDedicatedHostClusterId($value)
 * @method array getTag()
 * @method string getDedicatedHostType()
 * @method $this withDedicatedHostType($value)
 * @method string getAutoRenewPeriod()
 * @method $this withAutoRenewPeriod($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getQuantity()
 * @method $this withQuantity($value)
 * @method string getDedicatedHostName()
 * @method $this withDedicatedHostName($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getAutoReleaseTime()
 * @method $this withAutoReleaseTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getPeriodUnit()
 * @method $this withPeriodUnit($value)
 * @method string getAutoRenew()
 * @method $this withAutoRenew($value)
 * @method string getNetworkAttributesSlbUdpTimeout()
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getAutoPlacement()
 * @method $this withAutoPlacement($value)
 * @method string getChargeType()
 * @method $this withChargeType($value)
 * @method string getNetworkAttributesUdpTimeout()
 */
class AllocateDedicatedHosts extends Rpc
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
     * @param string $value
     *
     * @return $this
     */
    public function withNetworkAttributesSlbUdpTimeout($value)
    {
        $this->data['NetworkAttributesSlbUdpTimeout'] = $value;
        $this->options['query']['NetworkAttributes.SlbUdpTimeout'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNetworkAttributesUdpTimeout($value)
    {
        $this->data['NetworkAttributesUdpTimeout'] = $value;
        $this->options['query']['NetworkAttributes.UdpTimeout'] = $value;

        return $this;
    }
}
