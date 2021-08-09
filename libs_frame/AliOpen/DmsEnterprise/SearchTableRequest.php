<?php

namespace AliOpen\DmsEnterprise;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SearchTable
 *
 * @method string getSearchTarget()
 * @method string getPageSize()
 * @method string getEnvType()
 * @method string getSearchKey()
 * @method string getSearchRange()
 * @method string getTid()
 * @method string getPageNumber()
 */
class SearchTableRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('dms-enterprise', '2018-11-01', 'SearchTable');
    }

    /**
     * @param string $searchTarget
     *
     * @return $this
     */
    public function setSearchTarget($searchTarget)
    {
        $this->requestParameters['SearchTarget'] = $searchTarget;
        $this->queryParameters['SearchTarget'] = $searchTarget;

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
     * @param string $envType
     *
     * @return $this
     */
    public function setEnvType($envType)
    {
        $this->requestParameters['EnvType'] = $envType;
        $this->queryParameters['EnvType'] = $envType;

        return $this;
    }

    /**
     * @param string $searchKey
     *
     * @return $this
     */
    public function setSearchKey($searchKey)
    {
        $this->requestParameters['SearchKey'] = $searchKey;
        $this->queryParameters['SearchKey'] = $searchKey;

        return $this;
    }

    /**
     * @param string $searchRange
     *
     * @return $this
     */
    public function setSearchRange($searchRange)
    {
        $this->requestParameters['SearchRange'] = $searchRange;
        $this->queryParameters['SearchRange'] = $searchRange;

        return $this;
    }

    /**
     * @param string $tid
     *
     * @return $this
     */
    public function setTid($tid)
    {
        $this->requestParameters['Tid'] = $tid;
        $this->queryParameters['Tid'] = $tid;

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
