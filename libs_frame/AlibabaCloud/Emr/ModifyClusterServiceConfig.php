<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getRefreshHostConfig()
 * @method $this withRefreshHostConfig($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getHostInstanceId()
 * @method $this withHostInstanceId($value)
 * @method string getServiceName()
 * @method $this withServiceName($value)
 * @method array getGatewayClusterIdList()
 * @method string getConfigParams()
 * @method $this withConfigParams($value)
 * @method string getConfigType()
 * @method $this withConfigType($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getCustomConfigParams()
 * @method $this withCustomConfigParams($value)
 * @method string getComment()
 * @method $this withComment($value)
 */
class ModifyClusterServiceConfig extends Rpc
{
    /**
     * @return $this
     */
    public function withGatewayClusterIdList(array $gatewayClusterIdList)
    {
        $this->data['GatewayClusterIdList'] = $gatewayClusterIdList;
        foreach ($gatewayClusterIdList as $i => $iValue) {
            $this->options['query']['GatewayClusterIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
