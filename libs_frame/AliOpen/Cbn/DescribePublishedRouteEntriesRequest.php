<?php

namespace AliOpen\Cbn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribePublishedRouteEntries
 *
 * @method string getChildInstanceId()
 * @method string getResourceOwnerId()
 * @method string getResourceOwnerAccount()
 * @method string getCenId()
 * @method string getDestinationCidrBlock()
 * @method string getPageSize()
 * @method string getChildInstanceType()
 * @method string getChildInstanceRouteTableId()
 * @method string getPageNumber()
 * @method string getChildInstanceRegionId()
 */
class DescribePublishedRouteEntriesRequest extends RpcAcsRequest
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
            'DescribePublishedRouteEntries',
            'cbn'
        );
    }

    /**
     * @param string $childInstanceId
     *
     * @return $this
     */
    public function setChildInstanceId($childInstanceId)
    {
        $this->requestParameters['ChildInstanceId'] = $childInstanceId;
        $this->queryParameters['ChildInstanceId'] = $childInstanceId;

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
     * @param string $destinationCidrBlock
     *
     * @return $this
     */
    public function setDestinationCidrBlock($destinationCidrBlock)
    {
        $this->requestParameters['DestinationCidrBlock'] = $destinationCidrBlock;
        $this->queryParameters['DestinationCidrBlock'] = $destinationCidrBlock;

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
     * @param string $childInstanceType
     *
     * @return $this
     */
    public function setChildInstanceType($childInstanceType)
    {
        $this->requestParameters['ChildInstanceType'] = $childInstanceType;
        $this->queryParameters['ChildInstanceType'] = $childInstanceType;

        return $this;
    }

    /**
     * @param string $childInstanceRouteTableId
     *
     * @return $this
     */
    public function setChildInstanceRouteTableId($childInstanceRouteTableId)
    {
        $this->requestParameters['ChildInstanceRouteTableId'] = $childInstanceRouteTableId;
        $this->queryParameters['ChildInstanceRouteTableId'] = $childInstanceRouteTableId;

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
     * @param string $childInstanceRegionId
     *
     * @return $this
     */
    public function setChildInstanceRegionId($childInstanceRegionId)
    {
        $this->requestParameters['ChildInstanceRegionId'] = $childInstanceRegionId;
        $this->queryParameters['ChildInstanceRegionId'] = $childInstanceRegionId;

        return $this;
    }
}
