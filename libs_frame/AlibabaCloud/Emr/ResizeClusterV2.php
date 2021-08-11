<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getIsOpenPublicIp()
 * @method $this withIsOpenPublicIp($value)
 * @method string getAutoPayOrder()
 * @method $this withAutoPayOrder($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getVswitchId()
 * @method $this withVswitchId($value)
 * @method array getHostComponentInfo()
 * @method array getHostGroup()
 * @method array getPromotionInfo()
 */
class ResizeClusterV2 extends Rpc
{
    /**
     * @return $this
     */
    public function withHostComponentInfo(array $hostComponentInfo)
    {
        $this->data['HostComponentInfo'] = $hostComponentInfo;
        foreach ($hostComponentInfo as $depth1 => $depth1Value) {
            if (isset($depth1Value['HostName'])) {
                $this->options['query']['HostComponentInfo.' . ($depth1 + 1) . '.HostName'] = $depth1Value['HostName'];
            }
            foreach ($depth1Value['ComponentNameList'] as $i => $iValue) {
                $this->options['query']['HostComponentInfo.' . ($depth1 + 1) . '.ComponentNameList.' . ($i + 1)] = $iValue;
            }
            if (isset($depth1Value['ServiceName'])) {
                $this->options['query']['HostComponentInfo.' . ($depth1 + 1) . '.ServiceName'] = $depth1Value['ServiceName'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withHostGroup(array $hostGroup)
    {
        $this->data['HostGroup'] = $hostGroup;
        foreach ($hostGroup as $depth1 => $depth1Value) {
            if (isset($depth1Value['Period'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.Period'] = $depth1Value['Period'];
            }
            if (isset($depth1Value['SysDiskCapacity'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.SysDiskCapacity'] = $depth1Value['SysDiskCapacity'];
            }
            if (isset($depth1Value['HostKeyPairName'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.HostKeyPairName'] = $depth1Value['HostKeyPairName'];
            }
            if (isset($depth1Value['DiskCapacity'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.DiskCapacity'] = $depth1Value['DiskCapacity'];
            }
            if (isset($depth1Value['SysDiskType'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.SysDiskType'] = $depth1Value['SysDiskType'];
            }
            if (isset($depth1Value['ClusterId'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.ClusterId'] = $depth1Value['ClusterId'];
            }
            if (isset($depth1Value['DiskType'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.DiskType'] = $depth1Value['DiskType'];
            }
            if (isset($depth1Value['HostGroupName'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.HostGroupName'] = $depth1Value['HostGroupName'];
            }
            if (isset($depth1Value['VswitchId'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.VswitchId'] = $depth1Value['VswitchId'];
            }
            if (isset($depth1Value['DiskCount'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.DiskCount'] = $depth1Value['DiskCount'];
            }
            if (isset($depth1Value['AutoRenew'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.AutoRenew'] = $depth1Value['AutoRenew'];
            }
            if (isset($depth1Value['HostGroupId'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.HostGroupId'] = $depth1Value['HostGroupId'];
            }
            if (isset($depth1Value['NodeCount'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.NodeCount'] = $depth1Value['NodeCount'];
            }
            if (isset($depth1Value['InstanceType'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.InstanceType'] = $depth1Value['InstanceType'];
            }
            if (isset($depth1Value['Comment'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.Comment'] = $depth1Value['Comment'];
            }
            if (isset($depth1Value['ChargeType'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.ChargeType'] = $depth1Value['ChargeType'];
            }
            if (isset($depth1Value['CreateType'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.CreateType'] = $depth1Value['CreateType'];
            }
            if (isset($depth1Value['HostPassword'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.HostPassword'] = $depth1Value['HostPassword'];
            }
            if (isset($depth1Value['HostGroupType'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.HostGroupType'] = $depth1Value['HostGroupType'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withPromotionInfo(array $promotionInfo)
    {
        $this->data['PromotionInfo'] = $promotionInfo;
        foreach ($promotionInfo as $depth1 => $depth1Value) {
            if (isset($depth1Value['PromotionOptionCode'])) {
                $this->options['query']['PromotionInfo.' . ($depth1 + 1) . '.PromotionOptionCode'] = $depth1Value['PromotionOptionCode'];
            }
            if (isset($depth1Value['ProductCode'])) {
                $this->options['query']['PromotionInfo.' . ($depth1 + 1) . '.ProductCode'] = $depth1Value['ProductCode'];
            }
            if (isset($depth1Value['PromotionOptionNo'])) {
                $this->options['query']['PromotionInfo.' . ($depth1 + 1) . '.PromotionOptionNo'] = $depth1Value['PromotionOptionNo'];
            }
        }

        return $this;
    }
}
