<?php

namespace AliOpen\Vpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeRouterInterfaces
 *
 * @method array getFilters()
 * @method string getResourceOwnerId()
 * @method string getResourceOwnerAccount()
 * @method string getPageSize()
 * @method string getOwnerId()
 * @method string getIncludeReservationData()
 * @method string getPageNumber()
 */
class DescribeRouterInterfacesRequest extends RpcAcsRequest
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
        parent::__construct('Vpc', '2016-04-28', 'DescribeRouterInterfaces', 'vpc');
    }

    /**
     * @return $this
     */
    public function setFilters(array $filters)
    {
        $this->requestParameters['Filters'] = $filters;
        foreach ($filters as $i => $iValue) {
            foreach ($filters[$i]['Values'] as $j => $jValue) {
                $this->queryParameters['Filter.' . ($i + 1) . '.Value.' . ($j + 1)] = $jValue;
            }
            $this->queryParameters['Filter.' . ($i + 1) . '.Key'] = $filters[$i]['Key'];
        }

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
     * @param string $includeReservationData
     *
     * @return $this
     */
    public function setIncludeReservationData($includeReservationData)
    {
        $this->requestParameters['IncludeReservationData'] = $includeReservationData;
        $this->queryParameters['IncludeReservationData'] = $includeReservationData;

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
}
