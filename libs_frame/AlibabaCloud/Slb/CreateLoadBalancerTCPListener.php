<?php

namespace AlibabaCloud\Slb;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getHealthCheckURI()
 * @method $this withHealthCheckURI($value)
 * @method string getAclStatus()
 * @method $this withAclStatus($value)
 * @method string getHealthCheckTcpFastCloseEnabled()
 * @method $this withHealthCheckTcpFastCloseEnabled($value)
 * @method string getAclType()
 * @method $this withAclType($value)
 * @method string getEstablishedTimeout()
 * @method $this withEstablishedTimeout($value)
 * @method string getFailoverStrategy()
 * @method $this withFailoverStrategy($value)
 * @method string getPersistenceTimeout()
 * @method $this withPersistenceTimeout($value)
 * @method string getVpcIds()
 * @method $this withVpcIds($value)
 * @method string getMasterSlaveModeEnabled()
 * @method $this withMasterSlaveModeEnabled($value)
 * @method string getVServerGroupId()
 * @method $this withVServerGroupId($value)
 * @method string getAclId()
 * @method $this withAclId($value)
 * @method array getPortRange()
 * @method string getHealthCheckMethod()
 * @method $this withHealthCheckMethod($value)
 * @method string getHealthCheckDomain()
 * @method $this withHealthCheckDomain($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getLoadBalancerId()
 * @method $this withLoadBalancerId($value)
 * @method string getMasterSlaveServerGroupId()
 * @method $this withMasterSlaveServerGroupId($value)
 * @method string getBackendServerPort()
 * @method $this withBackendServerPort($value)
 * @method string getHealthCheckInterval()
 * @method string getFailoverThreshold()
 * @method $this withFailoverThreshold($value)
 * @method string getProxyProtocolV2Enabled()
 * @method $this withProxyProtocolV2Enabled($value)
 * @method string getConnectionDrain()
 * @method $this withConnectionDrain($value)
 * @method string getHealthCheckSwitch()
 * @method $this withHealthCheckSwitch($value)
 * @method string getAccessKeyId()
 * @method string getHealthCheckConnectTimeout()
 * @method $this withHealthCheckConnectTimeout($value)
 * @method string getSlaveServerGroupId()
 * @method $this withSlaveServerGroupId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getUnhealthyThreshold()
 * @method $this withUnhealthyThreshold($value)
 * @method string getHealthyThreshold()
 * @method $this withHealthyThreshold($value)
 * @method string getScheduler()
 * @method $this withScheduler($value)
 * @method string getMaxConnection()
 * @method $this withMaxConnection($value)
 * @method string getMasterServerGroupId()
 * @method $this withMasterServerGroupId($value)
 * @method string getListenerPort()
 * @method $this withListenerPort($value)
 * @method string getHealthCheckType()
 * @method $this withHealthCheckType($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBandwidth()
 * @method $this withBandwidth($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getConnectionDrainTimeout()
 * @method $this withConnectionDrainTimeout($value)
 * @method string getHealthCheckConnectPort()
 * @method $this withHealthCheckConnectPort($value)
 * @method string getHealthCheckHttpCode()
 * @method $this withHealthCheckHttpCode($value)
 */
class CreateLoadBalancerTCPListener extends Rpc
{
    /**
     * @return $this
     */
    public function withPortRange(array $portRange)
    {
        $this->data['PortRange'] = $portRange;
        foreach ($portRange as $depth1 => $depth1Value) {
            if (isset($depth1Value['StartPort'])) {
                $this->options['query']['PortRange.' . ($depth1 + 1) . '.StartPort'] = $depth1Value['StartPort'];
            }
            if (isset($depth1Value['EndPort'])) {
                $this->options['query']['PortRange.' . ($depth1 + 1) . '.EndPort'] = $depth1Value['EndPort'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHealthCheckInterval($value)
    {
        $this->data['HealthCheckInterval'] = $value;
        $this->options['query']['healthCheckInterval'] = $value;

        return $this;
    }

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
