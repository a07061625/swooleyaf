<?php

namespace AlibabaCloud\Servicemesh;

/**
 * @method string getProxyRequestCPU()
 * @method string getOPALimitCPU()
 * @method string getOpenAgentPolicy()
 * @method string getOpaEnabled()
 * @method string getProxyLimitMemory()
 * @method string getCniExcludeNamespaces()
 * @method string getOPALogLevel()
 * @method string getCustomizedZipkin()
 * @method string getSidecarInjectorRequestCPU()
 * @method string getCniEnabled()
 * @method string getTracing()
 * @method string getIncludeIPRanges()
 * @method string getOPALimitMemory()
 * @method string getCADisableSecretAutoGeneration()
 * @method string getCAListenedNamespaces()
 * @method string getProxyLimitCPU()
 * @method string getProxyRequestMemory()
 * @method string getTelemetry()
 * @method string getOPARequestCPU()
 * @method string getSidecarInjectorWebhookAsYaml()
 * @method string getOPARequestMemory()
 * @method string getAutoInjectionPolicyEnabled()
 * @method string getSidecarInjectorLimitMemory()
 * @method string getEnableAudit()
 * @method string getClusterDomain()
 * @method string getSidecarInjectorRequestMemory()
 * @method string getServiceMeshId()
 * @method string getLocalityLoadBalancing()
 * @method string getSidecarInjectorLimitCPU()
 * @method string getTraceSampling()
 * @method string getHttp10Enabled()
 * @method string getAppNamespaces()
 * @method string getPilotPublicEip()
 * @method string getAuditProject()
 * @method string getOutboundTrafficPolicy()
 * @method string getEnableNamespacesByDefault()
 */
class UpdateMeshFeature extends Rpc
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
    public function withCniExcludeNamespaces($value)
    {
        $this->data['CniExcludeNamespaces'] = $value;
        $this->options['form_params']['CniExcludeNamespaces'] = $value;

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
    public function withCustomizedZipkin($value)
    {
        $this->data['CustomizedZipkin'] = $value;
        $this->options['form_params']['CustomizedZipkin'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSidecarInjectorRequestCPU($value)
    {
        $this->data['SidecarInjectorRequestCPU'] = $value;
        $this->options['form_params']['SidecarInjectorRequestCPU'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCniEnabled($value)
    {
        $this->data['CniEnabled'] = $value;
        $this->options['form_params']['CniEnabled'] = $value;

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
    public function withSidecarInjectorWebhookAsYaml($value)
    {
        $this->data['SidecarInjectorWebhookAsYaml'] = $value;
        $this->options['form_params']['SidecarInjectorWebhookAsYaml'] = $value;

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
    public function withAutoInjectionPolicyEnabled($value)
    {
        $this->data['AutoInjectionPolicyEnabled'] = $value;
        $this->options['form_params']['AutoInjectionPolicyEnabled'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSidecarInjectorLimitMemory($value)
    {
        $this->data['SidecarInjectorLimitMemory'] = $value;
        $this->options['form_params']['SidecarInjectorLimitMemory'] = $value;

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
    public function withSidecarInjectorRequestMemory($value)
    {
        $this->data['SidecarInjectorRequestMemory'] = $value;
        $this->options['form_params']['SidecarInjectorRequestMemory'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceMeshId($value)
    {
        $this->data['ServiceMeshId'] = $value;
        $this->options['form_params']['ServiceMeshId'] = $value;

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
    public function withSidecarInjectorLimitCPU($value)
    {
        $this->data['SidecarInjectorLimitCPU'] = $value;
        $this->options['form_params']['SidecarInjectorLimitCPU'] = $value;

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
    public function withHttp10Enabled($value)
    {
        $this->data['Http10Enabled'] = $value;
        $this->options['form_params']['Http10Enabled'] = $value;

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
    public function withEnableNamespacesByDefault($value)
    {
        $this->data['EnableNamespacesByDefault'] = $value;
        $this->options['form_params']['EnableNamespacesByDefault'] = $value;

        return $this;
    }
}
