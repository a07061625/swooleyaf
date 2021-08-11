<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getBusinessCode()
 * @method $this withBusinessCode($value)
 * @method string getCreateWithLogIntegration()
 * @method $this withCreateWithLogIntegration($value)
 * @method array getVswitchids()
 * @method string getCloudMonitorFlags()
 * @method $this withCloudMonitorFlags($value)
 * @method string getClusterEnvType()
 * @method $this withClusterEnvType($value)
 * @method string getCreateWithArmsIntegration()
 * @method $this withCreateWithArmsIntegration($value)
 * @method string getKeyPair()
 * @method $this withKeyPair($value)
 * @method string getClusterTitle()
 * @method $this withClusterTitle($value)
 * @method string getPodCIDR()
 * @method $this withPodCIDR($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getClusterType()
 * @method $this withClusterType($value)
 * @method string getPassword()
 * @method $this withPassword($value)
 * @method string getSnatEntry()
 * @method $this withSnatEntry($value)
 * @method string getNetPlug()
 * @method $this withNetPlug($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getRegionName()
 * @method $this withRegionName($value)
 * @method string getPrivateZone()
 * @method $this withPrivateZone($value)
 * @method string getServiceCIDR()
 * @method $this withServiceCIDR($value)
 * @method string getPublicSlb()
 * @method $this withPublicSlb($value)
 */
class CreateCluster extends Rpc
{
    /**
     * @return $this
     */
    public function withVswitchids(array $vswitchids)
    {
        $this->data['Vswitchids'] = $vswitchids;
        foreach ($vswitchids as $i => $iValue) {
            $this->options['query']['Vswitchids.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
