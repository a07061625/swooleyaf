<?php

namespace AliOpen\Ecs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribePhysicalConnections
 *
 * @method string getResourceOwnerId()
 * @method string getClientToken()
 * @method string getPageNumber()
 * @method string getPageSize()
 * @method string getUserCidr()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method array getFilters()
 */
class PhysicalConnectionsDescribeRequest extends RpcAcsRequest
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
        parent::__construct('Ecs', '2014-05-26', 'DescribePhysicalConnections', 'ecs');
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
     * @param string $pageNumber
     *
     * @return $this
     */
    public function setPageNumber($pageNumber)
    {
        $this->requestParameters['PageNumber'] = $pageNumber;
        $this->queryParameters['PageNumber'] = $pageNumber;

        return $this;
    }

    /**
     * @param string $pageSize
     *
     * @return $this
     */
    public function setPageSize($pageSize)
    {
        $this->requestParameters['PageSize'] = $pageSize;
        $this->queryParameters['PageSize'] = $pageSize;

        return $this;
    }

    /**
     * @param string $userCidr
     *
     * @return $this
     */
    public function setUserCidr($userCidr)
    {
        $this->requestParameters['UserCidr'] = $userCidr;
        $this->queryParameters['UserCidr'] = $userCidr;

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
     * @return $this
     */
    public function setFilters(array $filter)
    {
        $this->requestParameters['Filters'] = $filter;
        foreach ($filter as $depth1 => $depth1Value) {
            foreach ($depth1Value['Value'] as $i => $iValue) {
                $this->queryParameters['Filter.' . ($depth1 + 1) . '.Value.' . ($i + 1)] = $iValue;
            }
            $this->queryParameters['Filter.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
        }

        return $this;
    }
}
