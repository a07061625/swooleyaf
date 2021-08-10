<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTimeInterval()
 * @method $this withTimeInterval($value)
 * @method string getLogPath()
 * @method $this withLogPath($value)
 * @method string getClusterName()
 * @method $this withClusterName($value)
 * @method string getConfigurations()
 * @method $this withConfigurations($value)
 * @method string getCreateClusterOnDemand()
 * @method $this withCreateClusterOnDemand($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method array getBootstrapAction()
 * @method string getEmrVer()
 * @method $this withEmrVer($value)
 * @method string getIsOpenPublicIp()
 * @method $this withIsOpenPublicIp($value)
 * @method string getInstanceGeneration()
 * @method $this withInstanceGeneration($value)
 * @method string getClusterType()
 * @method $this withClusterType($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method array getOptionSoftWareList()
 * @method string getNetType()
 * @method $this withNetType($value)
 * @method array getEcsOrder()
 * @method string getName()
 * @method $this withName($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getUseCustomHiveMetaDB()
 * @method $this withUseCustomHiveMetaDB($value)
 * @method string getInitCustomHiveMetaDB()
 * @method $this withInitCustomHiveMetaDB($value)
 * @method string getIoOptimized()
 * @method $this withIoOptimized($value)
 * @method string getSecurityGroupId()
 * @method $this withSecurityGroupId($value)
 * @method string getEasEnable()
 * @method $this withEasEnable($value)
 * @method array getJobIdList()
 * @method string getDayOfMonth()
 * @method $this withDayOfMonth($value)
 * @method string getUseLocalMetaDb()
 * @method $this withUseLocalMetaDb($value)
 * @method string getUserDefinedEmrEcsRole()
 * @method $this withUserDefinedEmrEcsRole($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getTimeUnit()
 * @method $this withTimeUnit($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getWorkflowDefinition()
 * @method $this withWorkflowDefinition($value)
 * @method string getDayOfWeek()
 * @method $this withDayOfWeek($value)
 * @method string getStrategy()
 * @method $this withStrategy($value)
 * @method array getConfig()
 * @method string getHighAvailabilityEnable()
 * @method $this withHighAvailabilityEnable($value)
 * @method string getLogEnable()
 * @method $this withLogEnable($value)
 */
class CreateExecutionPlan extends Rpc
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
    public function withEcsOrder(array $ecsOrder)
    {
        $this->data['EcsOrder'] = $ecsOrder;
        foreach ($ecsOrder as $depth1 => $depth1Value) {
            if (isset($depth1Value['NodeType'])) {
                $this->options['query']['EcsOrder.' . ($depth1 + 1) . '.NodeType'] = $depth1Value['NodeType'];
            }
            if (isset($depth1Value['DiskCount'])) {
                $this->options['query']['EcsOrder.' . ($depth1 + 1) . '.DiskCount'] = $depth1Value['DiskCount'];
            }
            if (isset($depth1Value['NodeCount'])) {
                $this->options['query']['EcsOrder.' . ($depth1 + 1) . '.NodeCount'] = $depth1Value['NodeCount'];
            }
            if (isset($depth1Value['DiskCapacity'])) {
                $this->options['query']['EcsOrder.' . ($depth1 + 1) . '.DiskCapacity'] = $depth1Value['DiskCapacity'];
            }
            if (isset($depth1Value['Index'])) {
                $this->options['query']['EcsOrder.' . ($depth1 + 1) . '.Index'] = $depth1Value['Index'];
            }
            if (isset($depth1Value['InstanceType'])) {
                $this->options['query']['EcsOrder.' . ($depth1 + 1) . '.InstanceType'] = $depth1Value['InstanceType'];
            }
            if (isset($depth1Value['DiskType'])) {
                $this->options['query']['EcsOrder.' . ($depth1 + 1) . '.DiskType'] = $depth1Value['DiskType'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withJobIdList(array $jobIdList)
    {
        $this->data['JobIdList'] = $jobIdList;
        foreach ($jobIdList as $i => $iValue) {
            $this->options['query']['JobIdList.' . ($i + 1)] = $iValue;
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
