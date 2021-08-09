<?php

namespace AliOpen\Pvtz;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeZones
 *
 * @method string getQueryVpcId()
 * @method string getPageNumber()
 * @method string getResourceGroupId()
 * @method string getPageSize()
 * @method string getLang()
 * @method string getKeyword()
 * @method string getDirection()
 * @method string getOrderBy()
 * @method string getUserClientIp()
 * @method string getSearchMode()
 * @method string getQueryRegionId()
 */
class DescribeZonesRequest extends RpcAcsRequest
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
        parent::__construct('pvtz', '2018-01-01', 'DescribeZones', 'pvtz');
    }

    /**
     * @param string $queryVpcId
     *
     * @return $this
     */
    public function setQueryVpcId($queryVpcId)
    {
        $this->requestParameters['QueryVpcId'] = $queryVpcId;
        $this->queryParameters['QueryVpcId'] = $queryVpcId;

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
     * @param string $resourceGroupId
     *
     * @return $this
     */
    public function setResourceGroupId($resourceGroupId)
    {
        $this->requestParameters['ResourceGroupId'] = $resourceGroupId;
        $this->queryParameters['ResourceGroupId'] = $resourceGroupId;

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
     * @param string $lang
     *
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }

    /**
     * @param string $keyword
     *
     * @return $this
     */
    public function setKeyword($keyword)
    {
        $this->requestParameters['Keyword'] = $keyword;
        $this->queryParameters['Keyword'] = $keyword;

        return $this;
    }

    /**
     * @param string $direction
     *
     * @return $this
     */
    public function setDirection($direction)
    {
        $this->requestParameters['Direction'] = $direction;
        $this->queryParameters['Direction'] = $direction;

        return $this;
    }

    /**
     * @param string $orderBy
     *
     * @return $this
     */
    public function setOrderBy($orderBy)
    {
        $this->requestParameters['OrderBy'] = $orderBy;
        $this->queryParameters['OrderBy'] = $orderBy;

        return $this;
    }

    /**
     * @param string $userClientIp
     *
     * @return $this
     */
    public function setUserClientIp($userClientIp)
    {
        $this->requestParameters['UserClientIp'] = $userClientIp;
        $this->queryParameters['UserClientIp'] = $userClientIp;

        return $this;
    }

    /**
     * @param string $searchMode
     *
     * @return $this
     */
    public function setSearchMode($searchMode)
    {
        $this->requestParameters['SearchMode'] = $searchMode;
        $this->queryParameters['SearchMode'] = $searchMode;

        return $this;
    }

    /**
     * @param string $queryRegionId
     *
     * @return $this
     */
    public function setQueryRegionId($queryRegionId)
    {
        $this->requestParameters['QueryRegionId'] = $queryRegionId;
        $this->queryParameters['QueryRegionId'] = $queryRegionId;

        return $this;
    }
}
