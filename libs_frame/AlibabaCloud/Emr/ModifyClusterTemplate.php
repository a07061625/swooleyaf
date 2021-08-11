<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getLogPath()
 * @method $this withLogPath($value)
 * @method string getMasterPwd()
 * @method $this withMasterPwd($value)
 * @method string getConfigurations()
 * @method $this withConfigurations($value)
 * @method string getSshEnable()
 * @method $this withSshEnable($value)
 * @method string getKeyPairName()
 * @method $this withKeyPairName($value)
 * @method string getMetaStoreType()
 * @method $this withMetaStoreType($value)
 * @method string getSecurityGroupName()
 * @method $this withSecurityGroupName($value)
 * @method string getMachineType()
 * @method $this withMachineType($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method array getBootstrapAction()
 * @method string getMetaStoreConf()
 * @method $this withMetaStoreConf($value)
 * @method string getEmrVer()
 * @method $this withEmrVer($value)
 * @method array getTag()
 * @method string getIsOpenPublicIp()
 * @method $this withIsOpenPublicIp($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getInstanceGeneration()
 * @method $this withInstanceGeneration($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getClusterType()
 * @method $this withClusterType($value)
 * @method string getAutoRenew()
 * @method $this withAutoRenew($value)
 * @method array getOptionSoftWareList()
 * @method string getNetType()
 * @method $this withNetType($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getUseCustomHiveMetaDb()
 * @method $this withUseCustomHiveMetaDb($value)
 * @method string getInitCustomHiveMetaDb()
 * @method $this withInitCustomHiveMetaDb($value)
 * @method string getIoOptimized()
 * @method $this withIoOptimized($value)
 * @method string getSecurityGroupId()
 * @method $this withSecurityGroupId($value)
 * @method string getEasEnable()
 * @method $this withEasEnable($value)
 * @method string getDepositType()
 * @method $this withDepositType($value)
 * @method string getUseLocalMetaDb()
 * @method $this withUseLocalMetaDb($value)
 * @method string getTemplateName()
 * @method $this withTemplateName($value)
 * @method string getUserDefinedEmrEcsRole()
 * @method $this withUserDefinedEmrEcsRole($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method array getHostGroup()
 * @method string getChargeType()
 * @method $this withChargeType($value)
 * @method array getConfig()
 * @method string getHighAvailabilityEnable()
 * @method $this withHighAvailabilityEnable($value)
 */
class ModifyClusterTemplate extends Rpc
{
    /**
     * @return $this
     */
    public function withBootstrapAction(array $bootstrapAction)
    {
        $this->data['BootstrapAction'] = $bootstrapAction;
        foreach ($bootstrapAction as $depth1 => $depth1Value) {
            if (isset($depth1Value['Path'])) {
                $this->options['query']['BootstrapAction.' . ($depth1 + 1) . '.Path'] = $depth1Value['Path'];
            }
            if (isset($depth1Value['ExecutionTarget'])) {
                $this->options['query']['BootstrapAction.' . ($depth1 + 1) . '.ExecutionTarget'] = $depth1Value['ExecutionTarget'];
            }
            if (isset($depth1Value['ExecutionMoment'])) {
                $this->options['query']['BootstrapAction.' . ($depth1 + 1) . '.ExecutionMoment'] = $depth1Value['ExecutionMoment'];
            }
            if (isset($depth1Value['Arg'])) {
                $this->options['query']['BootstrapAction.' . ($depth1 + 1) . '.Arg'] = $depth1Value['Arg'];
            }
            if (isset($depth1Value['Name'])) {
                $this->options['query']['BootstrapAction.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            }
            if (isset($depth1Value['ExecutionFailStrategy'])) {
                $this->options['query']['BootstrapAction.' . ($depth1 + 1) . '.ExecutionFailStrategy'] = $depth1Value['ExecutionFailStrategy'];
            }
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
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withOptionSoftWareList(array $optionSoftWareList)
    {
        $this->data['OptionSoftWareList'] = $optionSoftWareList;
        foreach ($optionSoftWareList as $i => $iValue) {
            $this->options['query']['OptionSoftWareList.' . ($i + 1)] = $iValue;
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
            if (isset($depth1Value['VSwitchId'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.VSwitchId'] = $depth1Value['VSwitchId'];
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
            if (isset($depth1Value['MultiInstanceTypes'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.MultiInstanceTypes'] = $depth1Value['MultiInstanceTypes'];
            }
            if (isset($depth1Value['CreateType'])) {
                $this->options['query']['HostGroup.' . ($depth1 + 1) . '.CreateType'] = $depth1Value['CreateType'];
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
    public function withConfig(array $config)
    {
        $this->data['Config'] = $config;
        foreach ($config as $depth1 => $depth1Value) {
            if (isset($depth1Value['ConfigKey'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.ConfigKey'] = $depth1Value['ConfigKey'];
            }
            if (isset($depth1Value['FileName'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.FileName'] = $depth1Value['FileName'];
            }
            if (isset($depth1Value['Encrypt'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.Encrypt'] = $depth1Value['Encrypt'];
            }
            if (isset($depth1Value['Replace'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.Replace'] = $depth1Value['Replace'];
            }
            if (isset($depth1Value['ConfigValue'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.ConfigValue'] = $depth1Value['ConfigValue'];
            }
            if (isset($depth1Value['ServiceName'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.ServiceName'] = $depth1Value['ServiceName'];
            }
        }

        return $this;
    }
}
