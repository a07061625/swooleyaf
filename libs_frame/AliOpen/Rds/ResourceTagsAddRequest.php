<?php
namespace AliOpen\Rds;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of AddTagsToResource
 * @method string getTag4value()
 * @method string getResourceOwnerId()
 * @method string getTag2key()
 * @method string getClientToken()
 * @method string getTag3key()
 * @method string getTag1value()
 * @method string getDBInstanceId()
 * @method string getTag3value()
 * @method string getproxyId()
 * @method string getTag5key()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getTag5value()
 * @method string getTags()
 * @method string getTag1key()
 * @method string getTag2value()
 * @method string getTag4key()
 */
class ResourceTagsAddRequest extends RpcAcsRequest
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
        parent::__construct('Rds', '2014-08-15', 'AddTagsToResource', 'rds');
    }

    /**
     * @param string $tag4value
     * @return $this
     */
    public function setTag4value($tag4value)
    {
        $this->requestParameters['Tag4value'] = $tag4value;
        $this->queryParameters['Tag.4.value'] = $tag4value;

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
     * @param string $tag2key
     * @return $this
     */
    public function setTag2key($tag2key)
    {
        $this->requestParameters['Tag2key'] = $tag2key;
        $this->queryParameters['Tag.2.key'] = $tag2key;

        return $this;
    }

    /**
     * @param string $clientToken
     * @return $this
     */
    public function setClientToken($clientToken)
    {
        $this->requestParameters['ClientToken'] = $clientToken;
        $this->queryParameters['ClientToken'] = $clientToken;

        return $this;
    }

    /**
     * @param string $tag3key
     * @return $this
     */
    public function setTag3key($tag3key)
    {
        $this->requestParameters['Tag3key'] = $tag3key;
        $this->queryParameters['Tag.3.key'] = $tag3key;

        return $this;
    }

    /**
     * @param string $tag1value
     * @return $this
     */
    public function setTag1value($tag1value)
    {
        $this->requestParameters['Tag1value'] = $tag1value;
        $this->queryParameters['Tag.1.value'] = $tag1value;

        return $this;
    }

    /**
     * @param string $dBInstanceId
     * @return $this
     */
    public function setDBInstanceId($dBInstanceId)
    {
        $this->requestParameters['DBInstanceId'] = $dBInstanceId;
        $this->queryParameters['DBInstanceId'] = $dBInstanceId;

        return $this;
    }

    /**
     * @param string $tag3value
     * @return $this
     */
    public function setTag3value($tag3value)
    {
        $this->requestParameters['Tag3value'] = $tag3value;
        $this->queryParameters['Tag.3.value'] = $tag3value;

        return $this;
    }

    /**
     * @param string $proxyId
     * @return $this
     */
    public function setproxyId($proxyId)
    {
        $this->requestParameters['proxyId'] = $proxyId;
        $this->queryParameters['proxyId'] = $proxyId;

        return $this;
    }

    /**
     * @param string $tag5key
     * @return $this
     */
    public function setTag5key($tag5key)
    {
        $this->requestParameters['Tag5key'] = $tag5key;
        $this->queryParameters['Tag.5.key'] = $tag5key;

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

    /**
     * @param string $tag5value
     * @return $this
     */
    public function setTag5value($tag5value)
    {
        $this->requestParameters['Tag5value'] = $tag5value;
        $this->queryParameters['Tag.5.value'] = $tag5value;

        return $this;
    }

    /**
     * @param string $tags
     * @return $this
     */
    public function setTags($tags)
    {
        $this->requestParameters['Tags'] = $tags;
        $this->queryParameters['Tags'] = $tags;

        return $this;
    }

    /**
     * @param string $tag1key
     * @return $this
     */
    public function setTag1key($tag1key)
    {
        $this->requestParameters['Tag1key'] = $tag1key;
        $this->queryParameters['Tag.1.key'] = $tag1key;

        return $this;
    }

    /**
     * @param string $tag2value
     * @return $this
     */
    public function setTag2value($tag2value)
    {
        $this->requestParameters['Tag2value'] = $tag2value;
        $this->queryParameters['Tag.2.value'] = $tag2value;

        return $this;
    }

    /**
     * @param string $tag4key
     * @return $this
     */
    public function setTag4key($tag4key)
    {
        $this->requestParameters['Tag4key'] = $tag4key;
        $this->queryParameters['Tag.4.key'] = $tag4key;

        return $this;
    }
}
