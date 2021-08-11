<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method array getRealServers()
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getDomain()
 * @method $this withDomain($value)
 */
class DescribeL7RsPolicy extends Rpc
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
}
