<?php

namespace AliOpen\Vpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyNqa
 *
 * @method string getDestinationIp()
 * @method string getResourceOwnerId()
 * @method string getResourceOwnerAccount()
 * @method string getClientToken()
 * @method string getOwnerAccount()
 * @method string getNqaId()
 * @method string getOwnerId()
 */
class ModifyNqaRequest extends RpcAcsRequest
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
        parent::__construct('Vpc', '2016-04-28', 'ModifyNqa', 'vpc');
    }

    /**
     * @param string $destinationIp
     *
     * @return $this
     */
    public function setDestinationIp($destinationIp)
    {
        $this->requestParameters['DestinationIp'] = $destinationIp;
        $this->queryParameters['DestinationIp'] = $destinationIp;

        return $this;
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
     * @param string $clientToken
     *
     * @return $this
     */
    public function setClientToken($clientToken)
    {
        $this->requestParameters['ClientToken'] = $clientToken;
        $this->queryParameters['ClientToken'] = $clientToken;

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
     * @param string $nqaId
     *
     * @return $this
     */
    public function setNqaId($nqaId)
    {
        $this->requestParameters['NqaId'] = $nqaId;
        $this->queryParameters['NqaId'] = $nqaId;

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
