<?php
namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeContainerApp
 * @method string getContainerId()
 */
class DescribeContainerAppRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'DescribeContainerApp', 'ehs');
    }

    /**
     * @param string $containerId
     * @return $this
     */
    public function setContainerId($containerId)
    {
        $this->requestParameters['ContainerId'] = $containerId;
        $this->queryParameters['ContainerId'] = $containerId;

        return $this;
    }
}
