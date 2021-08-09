<?php

namespace AliOpen\Cbn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeCenPrivateZoneRoutes
 *
 * @method string getResourceOwnerId()
 * @method string getResourceOwnerAccount()
 * @method string getCenId()
 * @method string getPageSize()
 * @method string getHostRegionId()
 * @method string getAccessRegionId()
 * @method string getPageNumber()
 */
class DescribeCenPrivateZoneRoutesRequest extends RpcAcsRequest
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
        parent::__construct(
            'Cbn',
            '2017-09-12',
            'DescribeCenPrivateZoneRoutes',
            'cbn'
        );
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
     * @param string $cenId
     *
     * @return $this
     */
    public function setCenId($cenId)
    {
        $this->requestParameters['CenId'] = $cenId;
        $this->queryParameters['CenId'] = $cenId;

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
     * @param string $hostRegionId
     *
     * @return $this
     */
    public function setHostRegionId($hostRegionId)
    {
        $this->requestParameters['HostRegionId'] = $hostRegionId;
        $this->queryParameters['HostRegionId'] = $hostRegionId;

        return $this;
    }

    /**
     * @param string $accessRegionId
     *
     * @return $this
     */
    public function setAccessRegionId($accessRegionId)
    {
        $this->requestParameters['AccessRegionId'] = $accessRegionId;
        $this->queryParameters['AccessRegionId'] = $accessRegionId;

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
