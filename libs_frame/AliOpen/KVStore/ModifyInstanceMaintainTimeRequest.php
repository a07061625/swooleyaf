<?php

namespace AliOpen\KVStore;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyInstanceMaintainTime
 *
 * @method string getResourceOwnerId()
 * @method string getSecurityToken()
 * @method string getMaintainStartTime()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getMaintainEndTime()
 * @method string getInstanceId()
 */
class ModifyInstanceMaintainTimeRequest extends RpcAcsRequest
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
        parent::__construct('R-kvstore', '2015-01-01', 'ModifyInstanceMaintainTime', 'redisa');
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
     * @param string $maintainStartTime
     *
     * @return $this
     */
    public function setMaintainStartTime($maintainStartTime)
    {
        $this->requestParameters['MaintainStartTime'] = $maintainStartTime;
        $this->queryParameters['MaintainStartTime'] = $maintainStartTime;

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
     * @param string $maintainEndTime
     *
     * @return $this
     */
    public function setMaintainEndTime($maintainEndTime)
    {
        $this->requestParameters['MaintainEndTime'] = $maintainEndTime;
        $this->queryParameters['MaintainEndTime'] = $maintainEndTime;

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
}
