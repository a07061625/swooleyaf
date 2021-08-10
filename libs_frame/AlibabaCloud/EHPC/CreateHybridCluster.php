<?php

namespace AlibabaCloud\EHPC;

/**
 * @method string getKeyPairName()
 * @method $this withKeyPairName($value)
 * @method string getMultiOs()
 * @method $this withMultiOs($value)
 * @method string getSecurityGroupName()
 * @method $this withSecurityGroupName($value)
 * @method string getOnPremiseVolumeRemotePath()
 * @method $this withOnPremiseVolumeRemotePath($value)
 * @method string getImageOwnerAlias()
 * @method $this withImageOwnerAlias($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPassword()
 * @method $this withPassword($value)
 * @method string getComputeSpotPriceLimit()
 * @method $this withComputeSpotPriceLimit($value)
 * @method string getOnPremiseVolumeLocalPath()
 * @method $this withOnPremiseVolumeLocalPath($value)
 * @method string getRemoteDirectory()
 * @method $this withRemoteDirectory($value)
 * @method string getComputeSpotStrategy()
 * @method $this withComputeSpotStrategy($value)
 * @method array getPostInstallScript()
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getDomain()
 * @method $this withDomain($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getVolumeId()
 * @method $this withVolumeId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getImageId()
 * @method $this withImageId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getEhpcVersion()
 * @method $this withEhpcVersion($value)
 * @method string getSecurityGroupId()
 * @method $this withSecurityGroupId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getEcsOrderComputeInstanceType()
 * @method string getJobQueue()
 * @method $this withJobQueue($value)
 * @method string getVolumeType()
 * @method $this withVolumeType($value)
 * @method string getOnPremiseVolumeMountPoint()
 * @method $this withOnPremiseVolumeMountPoint($value)
 * @method string getOnPremiseVolumeProtocol()
 * @method $this withOnPremiseVolumeProtocol($value)
 * @method string getVolumeProtocol()
 * @method $this withVolumeProtocol($value)
 * @method string getClientVersion()
 * @method $this withClientVersion($value)
 * @method string getOsTag()
 * @method $this withOsTag($value)
 * @method array getNodes()
 * @method array getApplication()
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getVolumeMountpoint()
 * @method $this withVolumeMountpoint($value)
 * @method string getSchedulerPreInstall()
 * @method $this withSchedulerPreInstall($value)
 * @method string getLocation()
 * @method $this withLocation($value)
 */
class CreateHybridCluster extends Rpc
{
    /**
     * @return $this
     */
    public function withPostInstallScript(array $postInstallScript)
    {
        $this->data['PostInstallScript'] = $postInstallScript;
        foreach ($postInstallScript as $depth1 => $depth1Value) {
            if (isset($depth1Value['Args'])) {
                $this->options['query']['PostInstallScript.' . ($depth1 + 1) . '.Args'] = $depth1Value['Args'];
            }
            if (isset($depth1Value['Url'])) {
                $this->options['query']['PostInstallScript.' . ($depth1 + 1) . '.Url'] = $depth1Value['Url'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEcsOrderComputeInstanceType($value)
    {
        $this->data['EcsOrderComputeInstanceType'] = $value;
        $this->options['query']['EcsOrder.Compute.InstanceType'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withNodes(array $nodes)
    {
        $this->data['Nodes'] = $nodes;
        foreach ($nodes as $depth1 => $depth1Value) {
            if (isset($depth1Value['IpAddress'])) {
                $this->options['query']['Nodes.' . ($depth1 + 1) . '.IpAddress'] = $depth1Value['IpAddress'];
            }
            if (isset($depth1Value['HostName'])) {
                $this->options['query']['Nodes.' . ($depth1 + 1) . '.HostName'] = $depth1Value['HostName'];
            }
            if (isset($depth1Value['Role'])) {
                $this->options['query']['Nodes.' . ($depth1 + 1) . '.Role'] = $depth1Value['Role'];
            }
            if (isset($depth1Value['AccountType'])) {
                $this->options['query']['Nodes.' . ($depth1 + 1) . '.AccountType'] = $depth1Value['AccountType'];
            }
            if (isset($depth1Value['SchedulerType'])) {
                $this->options['query']['Nodes.' . ($depth1 + 1) . '.SchedulerType'] = $depth1Value['SchedulerType'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withApplication(array $application)
    {
        $this->data['Application'] = $application;
        foreach ($application as $depth1 => $depth1Value) {
            if (isset($depth1Value['Tag'])) {
                $this->options['query']['Application.' . ($depth1 + 1) . '.Tag'] = $depth1Value['Tag'];
            }
        }

        return $this;
    }
}
