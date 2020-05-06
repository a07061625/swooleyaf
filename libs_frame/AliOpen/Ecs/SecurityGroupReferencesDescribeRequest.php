<?php
namespace AliOpen\Ecs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeSecurityGroupReferences
 * @method string getResourceOwnerId()
 * @method array getSecurityGroupIds()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 */
class SecurityGroupReferencesDescribeRequest extends RpcAcsRequest
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
        parent::__construct('Ecs', '2014-05-26', 'DescribeSecurityGroupReferences', 'ecs');
    }

    /**
     * @param string $resourceOwnerId
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param array $securityGroupId
     * @return $this
     */
    public function setSecurityGroupIds(array $securityGroupId)
    {
        $this->requestParameters['SecurityGroupIds'] = $securityGroupId;
        foreach ($securityGroupId as $i => $iValue) {
            $this->queryParameters['SecurityGroupId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $resourceOwnerAccount
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
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }
}
