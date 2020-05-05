<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of BindInputBucket
 * @method string getBucket()
 * @method string getResourceOwnerId()
 * @method string getResourceOwnerAccount()
 * @method string getRoleArn()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 */
class InputBucketBindRequest extends RpcAcsRequest
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
        parent::__construct('Mts', '2014-06-18', 'BindInputBucket', 'mts');
    }

    /**
     * @param string $bucket
     * @return $this
     */
    public function setBucket($bucket)
    {
        $this->requestParameters['Bucket'] = $bucket;
        $this->queryParameters['Bucket'] = $bucket;

        return $this;
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
     * @param string $roleArn
     * @return $this
     */
    public function setRoleArn($roleArn)
    {
        $this->requestParameters['RoleArn'] = $roleArn;
        $this->queryParameters['RoleArn'] = $roleArn;

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
