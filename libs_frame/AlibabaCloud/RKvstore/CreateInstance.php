<?php

namespace AlibabaCloud\RKvstore;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSecondaryZoneId()
 * @method $this withSecondaryZoneId($value)
 * @method string getCouponNo()
 * @method $this withCouponNo($value)
 * @method string getNetworkType()
 * @method $this withNetworkType($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPassword()
 * @method $this withPassword($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method array getTag()
 * @method string getBusinessInfo()
 * @method $this withBusinessInfo($value)
 * @method string getShardCount()
 * @method $this withShardCount($value)
 * @method string getAutoRenewPeriod()
 * @method $this withAutoRenewPeriod($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getInstanceName()
 * @method $this withInstanceName($value)
 * @method string getAutoRenew()
 * @method $this withAutoRenew($value)
 * @method string getPort()
 * @method $this withPort($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getNodeType()
 * @method $this withNodeType($value)
 * @method string getAutoUseCoupon()
 * @method $this withAutoUseCoupon($value)
 * @method string getInstanceClass()
 * @method $this withInstanceClass($value)
 * @method string getCapacity()
 * @method $this withCapacity($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 * @method string getRestoreTime()
 * @method $this withRestoreTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getSrcDBInstanceId()
 * @method $this withSrcDBInstanceId($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getGlobalInstance()
 * @method $this withGlobalInstance($value)
 * @method string getToken()
 * @method $this withToken($value)
 * @method string getGlobalInstanceId()
 * @method $this withGlobalInstanceId($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getChargeType()
 * @method $this withChargeType($value)
 * @method string getConfig()
 * @method $this withConfig($value)
 */
class CreateInstance extends Rpc
{
    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }
}
