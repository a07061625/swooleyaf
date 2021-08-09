<?php

namespace AliOpen\DyPlsApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QuerySecretNoRemain
 *
 * @method string getSpecId()
 * @method string getResourceOwnerId()
 * @method string getCity()
 * @method string getSecretNo()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerId()
 */
class QuerySecretNoRemainRequest extends RpcAcsRequest
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
        parent::__construct('Dyplsapi', '2017-05-25', 'QuerySecretNoRemain', 'dypls');
    }

    /**
     * @param string $specId
     *
     * @return $this
     */
    public function setSpecId($specId)
    {
        $this->requestParameters['SpecId'] = $specId;
        $this->queryParameters['SpecId'] = $specId;

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
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->requestParameters['City'] = $city;
        $this->queryParameters['City'] = $city;

        return $this;
    }

    /**
     * @param string $secretNo
     *
     * @return $this
     */
    public function setSecretNo($secretNo)
    {
        $this->requestParameters['SecretNo'] = $secretNo;
        $this->queryParameters['SecretNo'] = $secretNo;

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
