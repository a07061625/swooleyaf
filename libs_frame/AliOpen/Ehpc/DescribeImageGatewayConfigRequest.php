<?php
namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeImageGatewayConfig
 * @method string getClusterId()
 */
class DescribeImageGatewayConfigRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'DescribeImageGatewayConfig', 'ehs');
    }

    /**
     * @param string $clusterId
     * @return $this
     */
    public function setClusterId($clusterId)
    {
        $this->requestParameters['ClusterId'] = $clusterId;
        $this->queryParameters['ClusterId'] = $clusterId;

        return $this;
    }
}
