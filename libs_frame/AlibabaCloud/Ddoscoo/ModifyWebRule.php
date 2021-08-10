<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getHttpsExt()
 * @method $this withHttpsExt($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getRsType()
 * @method $this withRsType($value)
 * @method array getRealServers()
 * @method string getProxyTypes()
 * @method $this withProxyTypes($value)
 * @method array getInstanceIds()
 * @method string getDomain()
 * @method $this withDomain($value)
 */
class ModifyWebRule extends Rpc
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
    public function withInstanceIds(array $instanceIds)
    {
        $this->data['InstanceIds'] = $instanceIds;
        foreach ($instanceIds as $i => $iValue) {
            $this->options['query']['InstanceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
