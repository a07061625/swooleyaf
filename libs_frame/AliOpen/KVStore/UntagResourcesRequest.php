<?php

namespace AliOpen\KVStore;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of UntagResources
 *
 * @method string getResourceOwnerId()
 * @method string getAll()
 * @method array getResourceIds()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getResourceType()
 * @method array getTagKeys()
 */
class UntagResourcesRequest extends RpcAcsRequest
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
        parent::__construct('R-kvstore', '2015-01-01', 'UntagResources', 'redisa');
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
     * @param string $all
     *
     * @return $this
     */
    public function setAll($all)
    {
        $this->requestParameters['All'] = $all;
        $this->queryParameters['All'] = $all;

        return $this;
    }

    /**
     * @return $this
     */
    public function setResourceIds(array $resourceId)
    {
        $this->requestParameters['ResourceIds'] = $resourceId;
        foreach ($resourceId as $i => $iValue) {
            $this->queryParameters['ResourceId.' . ($i + 1)] = $iValue;
        }

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
     * @param string $resourceType
     *
     * @return $this
     */
    public function setResourceType($resourceType)
    {
        $this->requestParameters['ResourceType'] = $resourceType;
        $this->queryParameters['ResourceType'] = $resourceType;

        return $this;
    }

    /**
     * @return $this
     */
    public function setTagKeys(array $tagKey)
    {
        $this->requestParameters['TagKeys'] = $tagKey;
        foreach ($tagKey as $i => $iValue) {
            $this->queryParameters['TagKey.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
