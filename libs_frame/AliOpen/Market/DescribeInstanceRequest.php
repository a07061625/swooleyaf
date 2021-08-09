<?php

namespace AliOpen\Market;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeInstance
 * @method string getOwnerId()
 * @method string getInstanceId()
 * @method string getOrderType()
 */
class DescribeInstanceRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Market', '2015-11-01', 'DescribeInstance', 'yunmarket');
    }

    /**
     * @param string $ownerId
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }

    /**
     * @param string $instanceId
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }

    /**
     * @param string $orderType
     * @return $this
     */
    public function setOrderType($orderType)
    {
        $this->requestParameters['OrderType'] = $orderType;
        $this->queryParameters['OrderType'] = $orderType;

        return $this;
    }
}
