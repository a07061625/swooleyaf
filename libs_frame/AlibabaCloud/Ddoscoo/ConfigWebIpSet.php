<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method array getBlackList()
 * @method array getWhiteList()
 * @method string getDomain()
 * @method $this withDomain($value)
 */
class ConfigWebIpSet extends Rpc
{
    /**
     * @return $this
     */
    public function withBlackList(array $blackList)
    {
        $this->data['BlackList'] = $blackList;
        foreach ($blackList as $i => $iValue) {
            $this->options['query']['BlackList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withWhiteList(array $whiteList)
    {
        $this->data['WhiteList'] = $whiteList;
        foreach ($whiteList as $i => $iValue) {
            $this->options['query']['WhiteList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
