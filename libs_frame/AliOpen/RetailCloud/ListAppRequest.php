<?php

namespace AliOpen\RetailCloud;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListApp
 *
 * @method string getPageSize()
 * @method string getPageNumber()
 */
class ListAppRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('retailcloud', '2018-03-13', 'ListApp', 'retailcloud');
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
