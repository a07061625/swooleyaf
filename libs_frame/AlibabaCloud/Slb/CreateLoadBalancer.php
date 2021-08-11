<?php

namespace AlibabaCloud\Slb;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getAddressIPVersion()
 * @method $this withAddressIPVersion($value)
 * @method string getMasterZoneId()
 * @method $this withMasterZoneId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSpecType()
 * @method $this withSpecType($value)
 * @method string getLoadBalancerName()
 * @method $this withLoadBalancerName($value)
 * @method string getSlaveZoneId()
 * @method $this withSlaveZoneId($value)
 * @method string getLoadBalancerSpec()
 * @method $this withLoadBalancerSpec($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getEnableVpcVipFlow()
 * @method $this withEnableVpcVipFlow($value)
 * @method string getInternetChargeType()
 * @method $this withInternetChargeType($value)
 * @method string getPricingCycle()
 * @method $this withPricingCycle($value)
 * @method string getAccessKeyId()
 * @method string getModificationProtectionReason()
 * @method $this withModificationProtectionReason($value)
 * @method string getSupportPrivateLink()
 * @method $this withSupportPrivateLink($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getCloudType()
 * @method $this withCloudType($value)
 * @method string getDuration()
 * @method $this withDuration($value)
 * @method string getAddressType()
 * @method $this withAddressType($value)
 * @method string getDeleteProtection()
 * @method $this withDeleteProtection($value)
 * @method string getAutoPay()
 * @method $this withAutoPay($value)
 * @method string getAddress()
 * @method $this withAddress($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBandwidth()
 * @method $this withBandwidth($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getModificationProtectionStatus()
 * @method $this withModificationProtectionStatus($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 * @method string getRatio()
 * @method $this withRatio($value)
 */
class CreateLoadBalancer extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessKeyId($value)
    {
        $this->data['AccessKeyId'] = $value;
        $this->options['query']['access_key_id'] = $value;

        return $this;
    }
}
