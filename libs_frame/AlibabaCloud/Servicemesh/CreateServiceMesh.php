<?php

namespace AlibabaCloud\Servicemesh;

/**
 * @method string getProxyRequestCPU()
 * @method string getOPALimitCPU()
 * @method string getOpenAgentPolicy()
 * @method string getOpaEnabled()
 * @method string getProxyLimitMemory()
 * @method string getStrictMTLS()
 * @method string getOPALogLevel()
 * @method string getExcludeIPRanges()
 * @method string getIstioVersion()
 * @method string getTracing()
 * @method string getIncludeIPRanges()
 * @method string getExcludeInboundPorts()
 * @method string getOPALimitMemory()
 * @method string getVSwitches()
 * @method string getCADisableSecretAutoGeneration()
 * @method string getCAListenedNamespaces()
 * @method string getProxyLimitCPU()
 * @method string getProxyRequestMemory()
 * @method string getName()
 * @method string getTelemetry()
 * @method string getOPARequestCPU()
 * @method string getOPARequestMemory()
 * @method string getEnableAudit()
 * @method string getClusterDomain()
 * @method string getLocalityLoadBalancing()
 * @method string getApiServerPublicEip()
 * @method string getTraceSampling()
 * @method string getAppNamespaces()
 * @method string getPilotPublicEip()
 * @method string getAuditProject()
 * @method string getOutboundTrafficPolicy()
 * @method string getVpcId()
 * @method string getExcludeOutboundPorts()
 */
class CreateServiceMesh extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyRequestCPU($value)
    {
        $this->data['ProxyRequestCPU'] = $value;
        $this->options['form_params']['ProxyRequestCPU'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOPALimitCPU($value)
    {
        $this->data['OPALimitCPU'] = $value;
        $this->options['form_params']['OPALimitCPU'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOpenAgentPolicy($value)
    {
        $this->data['OpenAgentPolicy'] = $value;
        $this->options['form_params']['OpenAgentPolicy'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOpaEnabled($value)
    {
        $this->data['OpaEnabled'] = $value;
        $this->options['form_params']['OpaEnabled'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyLimitMemory($value)
    {
        $this->data['ProxyLimitMemory'] = $value;
        $this->options['form_params']['ProxyLimitMemory'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStrictMTLS($value)
    {
        $this->data['StrictMTLS'] = $value;
        $this->options['form_params']['StrictMTLS'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOPALogLevel($value)
    {
        $this->data['OPALogLevel'] = $value;
        $this->options['form_params']['OPALogLevel'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExcludeIPRanges($value)
    {
        $this->data['ExcludeIPRanges'] = $value;
        $this->options['form_params']['ExcludeIPRanges'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIstioVersion($value)
    {
        $this->data['IstioVersion'] = $value;
        $this->options['form_params']['IstioVersion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTracing($value)
    {
        $this->data['Tracing'] = $value;
        $this->options['form_params']['Tracing'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIncludeIPRanges($value)
    {
        $this->data['IncludeIPRanges'] = $value;
        $this->options['form_params']['IncludeIPRanges'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExcludeInboundPorts($value)
    {
        $this->data['ExcludeInboundPorts'] = $value;
        $this->options['form_params']['ExcludeInboundPorts'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOPALimitMemory($value)
    {
        $this->data['OPALimitMemory'] = $value;
        $this->options['form_params']['OPALimitMemory'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVSwitches($value)
    {
        $this->data['VSwitches'] = $value;
        $this->options['form_params']['VSwitches'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCADisableSecretAutoGeneration($value)
    {
        $this->data['CADisableSecretAutoGeneration'] = $value;
        $this->options['form_params']['CADisableSecretAutoGeneration'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCAListenedNamespaces($value)
    {
        $this->data['CAListenedNamespaces'] = $value;
        $this->options['form_params']['CAListenedNamespaces'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyLimitCPU($value)
    {
        $this->data['ProxyLimitCPU'] = $value;
        $this->options['form_params']['ProxyLimitCPU'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyRequestMemory($value)
    {
        $this->data['ProxyRequestMemory'] = $value;
        $this->options['form_params']['ProxyRequestMemory'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTelemetry($value)
    {
        $this->data['Telemetry'] = $value;
        $this->options['form_params']['Telemetry'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOPARequestCPU($value)
    {
        $this->data['OPARequestCPU'] = $value;
        $this->options['form_params']['OPARequestCPU'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOPARequestMemory($value)
    {
        $this->data['OPARequestMemory'] = $value;
        $this->options['form_params']['OPARequestMemory'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnableAudit($value)
    {
        $this->data['EnableAudit'] = $value;
        $this->options['form_params']['EnableAudit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterDomain($value)
    {
        $this->data['ClusterDomain'] = $value;
        $this->options['form_params']['ClusterDomain'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLocalityLoadBalancing($value)
    {
        $this->data['LocalityLoadBalancing'] = $value;
        $this->options['form_params']['LocalityLoadBalancing'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiServerPublicEip($value)
    {
        $this->data['ApiServerPublicEip'] = $value;
        $this->options['form_params']['ApiServerPublicEip'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTraceSampling($value)
    {
        $this->data['TraceSampling'] = $value;
        $this->options['form_params']['TraceSampling'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppNamespaces($value)
    {
        $this->data['AppNamespaces'] = $value;
        $this->options['form_params']['AppNamespaces'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPilotPublicEip($value)
    {
        $this->data['PilotPublicEip'] = $value;
        $this->options['form_params']['PilotPublicEip'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAuditProject($value)
    {
        $this->data['AuditProject'] = $value;
        $this->options['form_params']['AuditProject'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOutboundTrafficPolicy($value)
    {
        $this->data['OutboundTrafficPolicy'] = $value;
        $this->options['form_params']['OutboundTrafficPolicy'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVpcId($value)
    {
        $this->data['VpcId'] = $value;
        $this->options['form_params']['VpcId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExcludeOutboundPorts($value)
    {
        $this->data['ExcludeOutboundPorts'] = $value;
        $this->options['form_params']['ExcludeOutboundPorts'] = $value;

        return $this;
    }
}
