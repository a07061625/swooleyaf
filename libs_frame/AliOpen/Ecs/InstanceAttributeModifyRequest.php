<?php

namespace AliOpen\Ecs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyInstanceAttribute
 *
 * @method string getResourceOwnerId()
 * @method string getRecyclable()
 * @method string getDescription()
 * @method string getDeletionProtection()
 * @method string getUserData()
 * @method string getPassword()
 * @method string getHostName()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getCreditSpecification()
 * @method string getOwnerId()
 * @method array getSecurityGroupIdss()
 * @method string getInstanceId()
 * @method string getInstanceName()
 */
class InstanceAttributeModifyRequest extends RpcAcsRequest
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
        parent::__construct('Ecs', '2014-05-26', 'ModifyInstanceAttribute', 'ecs');
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
     * @param string $recyclable
     *
     * @return $this
     */
    public function setRecyclable($recyclable)
    {
        $this->requestParameters['Recyclable'] = $recyclable;
        $this->queryParameters['Recyclable'] = $recyclable;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->requestParameters['Description'] = $description;
        $this->queryParameters['Description'] = $description;

        return $this;
    }

    /**
     * @param string $deletionProtection
     *
     * @return $this
     */
    public function setDeletionProtection($deletionProtection)
    {
        $this->requestParameters['DeletionProtection'] = $deletionProtection;
        $this->queryParameters['DeletionProtection'] = $deletionProtection;

        return $this;
    }

    /**
     * @param string $userData
     *
     * @return $this
     */
    public function setUserData($userData)
    {
        $this->requestParameters['UserData'] = $userData;
        $this->queryParameters['UserData'] = $userData;

        return $this;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->requestParameters['Password'] = $password;
        $this->queryParameters['Password'] = $password;

        return $this;
    }

    /**
     * @param string $hostName
     *
     * @return $this
     */
    public function setHostName($hostName)
    {
        $this->requestParameters['HostName'] = $hostName;
        $this->queryParameters['HostName'] = $hostName;

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
     * @param string $creditSpecification
     *
     * @return $this
     */
    public function setCreditSpecification($creditSpecification)
    {
        $this->requestParameters['CreditSpecification'] = $creditSpecification;
        $this->queryParameters['CreditSpecification'] = $creditSpecification;

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
     * @return $this
     */
    public function setSecurityGroupIdss(array $securityGroupIds)
    {
        $this->requestParameters['SecurityGroupIdss'] = $securityGroupIds;
        foreach ($securityGroupIds as $i => $iValue) {
            $this->queryParameters['SecurityGroupIds.' . ($i + 1)] = $iValue;
        }

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
     * @param string $instanceName
     *
     * @return $this
     */
    public function setInstanceName($instanceName)
    {
        $this->requestParameters['InstanceName'] = $instanceName;
        $this->queryParameters['InstanceName'] = $instanceName;

        return $this;
    }
}
