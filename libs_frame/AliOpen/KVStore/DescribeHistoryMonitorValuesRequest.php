<?php

namespace AliOpen\KVStore;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeHistoryMonitorValues
 *
 * @method string getResourceOwnerId()
 * @method string getStartTime()
 * @method string getSecurityToken()
 * @method string getIntervalForHistory()
 * @method string getNodeId()
 * @method string getAccessType()
 * @method string getProduct()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getEndTime()
 * @method string getOwnerId()
 * @method string getInstanceId()
 * @method string getCategory()
 * @method string getMonitorKeys()
 */
class DescribeHistoryMonitorValuesRequest extends RpcAcsRequest
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
        parent::__construct('R-kvstore', '2015-01-01', 'DescribeHistoryMonitorValues', 'redisa');
    }

    /**
     * @param string $resourceOwnerId
     *
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $startTime
     *
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->requestParameters['StartTime'] = $startTime;
        $this->queryParameters['StartTime'] = $startTime;

        return $this;
    }

    /**
     * @param string $securityToken
     *
     * @return $this
     */
    public function setSecurityToken($securityToken)
    {
        $this->requestParameters['SecurityToken'] = $securityToken;
        $this->queryParameters['SecurityToken'] = $securityToken;

        return $this;
    }

    /**
     * @param string $intervalForHistory
     *
     * @return $this
     */
    public function setIntervalForHistory($intervalForHistory)
    {
        $this->requestParameters['IntervalForHistory'] = $intervalForHistory;
        $this->queryParameters['IntervalForHistory'] = $intervalForHistory;

        return $this;
    }

    /**
     * @param string $nodeId
     *
     * @return $this
     */
    public function setNodeId($nodeId)
    {
        $this->requestParameters['NodeId'] = $nodeId;
        $this->queryParameters['NodeId'] = $nodeId;

        return $this;
    }

    /**
     * @param string $accessType
     *
     * @return $this
     */
    public function setAccessType($accessType)
    {
        $this->requestParameters['AccessType'] = $accessType;
        $this->queryParameters['AccessType'] = $accessType;

        return $this;
    }

    /**
     * @param string $product
     *
     * @return $this
     */
    public function setProduct($product)
    {
        $this->requestParameters['Product'] = $product;
        $this->queryParameters['Product'] = $product;

        return $this;
    }

    /**
     * @param string $resourceOwnerAccount
     *
     * @return $this
     */
    public function setResourceOwnerAccount($resourceOwnerAccount)
    {
        $this->requestParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;
        $this->queryParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;

        return $this;
    }

    /**
     * @param string $ownerAccount
     *
     * @return $this
     */
    public function setOwnerAccount($ownerAccount)
    {
        $this->requestParameters['OwnerAccount'] = $ownerAccount;
        $this->queryParameters['OwnerAccount'] = $ownerAccount;

        return $this;
    }

    /**
     * @param string $endTime
     *
     * @return $this
     */
    public function setEndTime($endTime)
    {
        $this->requestParameters['EndTime'] = $endTime;
        $this->queryParameters['EndTime'] = $endTime;

        return $this;
    }

    /**
     * @param string $ownerId
     *
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
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }

    /**
     * @param string $category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->requestParameters['Category'] = $category;
        $this->queryParameters['Category'] = $category;

        return $this;
    }

    /**
     * @param string $monitorKeys
     *
     * @return $this
     */
    public function setMonitorKeys($monitorKeys)
    {
        $this->requestParameters['MonitorKeys'] = $monitorKeys;
        $this->queryParameters['MonitorKeys'] = $monitorKeys;

        return $this;
    }
}
