<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getHttpsExt()
 * @method $this withHttpsExt($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getRsType()
 * @method $this withRsType($value)
 * @method array getRealServers()
 * @method array getProxyTypes()
 * @method array getInstanceIds()
 * @method string getDomain()
 * @method $this withDomain($value)
 */
class ModifyDomainResource extends Rpc
{
    /**
     * @return $this
     */
    public function withRealServers(array $realServers)
    {
        $this->data['RealServers'] = $realServers;
        foreach ($realServers as $i => $iValue) {
            $this->options['query']['RealServers.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withProxyTypes(array $proxyTypes)
    {
        $this->data['ProxyTypes'] = $proxyTypes;
        foreach ($proxyTypes as $depth1 => $depth1Value) {
            foreach ($depth1Value['ProxyPorts'] as $i => $iValue) {
                $this->options['query']['ProxyTypes.' . ($depth1 + 1) . '.ProxyPorts.' . ($i + 1)] = $iValue;
            }
            if (isset($depth1Value['ProxyType'])) {
                $this->options['query']['ProxyTypes.' . ($depth1 + 1) . '.ProxyType'] = $depth1Value['ProxyType'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withInstanceIds(array $instanceIds)
    {
        $this->data['InstanceIds'] = $instanceIds;
        foreach ($instanceIds as $i => $iValue) {
            $this->options['query']['InstanceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
