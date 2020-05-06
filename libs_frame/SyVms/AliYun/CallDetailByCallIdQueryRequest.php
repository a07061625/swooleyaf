<?php
namespace SyVms\AliYun;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryCallDetailByCallId
 * @method string getCallId()
 * @method string getResourceOwnerId()
 * @method string getQueryDate()
 * @method string getResourceOwnerAccount()
 * @method string getProdId()
 * @method string getOwnerId()
 */
class CallDetailByCallIdQueryRequest extends RpcAcsRequest
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
        parent::__construct('Dyvmsapi', '2017-05-25', 'QueryCallDetailByCallId', 'dyvmsapi');
    }

    /**
     * @param string $callId
     * @return $this
     */
    public function setCallId($callId)
    {
        $this->requestParameters['CallId'] = $callId;
        $this->queryParameters['CallId'] = $callId;

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
     * @param string $queryDate
     * @return $this
     */
    public function setQueryDate($queryDate)
    {
        $this->requestParameters['QueryDate'] = $queryDate;
        $this->queryParameters['QueryDate'] = $queryDate;

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
     * @param string $prodId
     * @return $this
     */
    public function setProdId($prodId)
    {
        $this->requestParameters['ProdId'] = $prodId;
        $this->queryParameters['ProdId'] = $prodId;

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
