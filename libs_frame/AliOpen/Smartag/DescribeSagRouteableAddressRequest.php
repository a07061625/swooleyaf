<?php

namespace AliOpen\Smartag;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeSagRouteableAddress
 *
 * @method string getResourceOwnerId()
 * @method string getResourceOwnerAccount()
 * @method string getSagId()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 */
class DescribeSagRouteableAddressRequest extends RpcAcsRequest
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
        parent::__construct('Smartag', '2018-03-13', 'DescribeSagRouteableAddress', 'smartag');
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
     * @param string $sagId
     *
     * @return $this
     */
    public function setSagId($sagId)
    {
        $this->requestParameters['SagId'] = $sagId;
        $this->queryParameters['SagId'] = $sagId;

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
}
