<?php

namespace AliOpen\DmsEnterprise;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetOpLog
 *
 * @method string getModule()
 * @method string getPageSize()
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getTid()
 * @method string getPageNumber()
 */
class GetOpLogRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('dms-enterprise', '2018-11-01', 'GetOpLog');
    }

    /**
     * @param string $module
     *
     * @return $this
     */
    public function setModule($module)
    {
        $this->requestParameters['Module'] = $module;
        $this->queryParameters['Module'] = $module;

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
     * @param string $endTime
     *
     * @return $this
     */
    public function setEndTime($endTime)
    {
        $this->requestParameters['EndTime'] = $endTime;
        $this->queryParameters['EndTime'] = $endTime;

        return $this;
    }

    /**
     * @param string $startTime
     *
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->requestParameters['StartTime'] = $startTime;
        $this->queryParameters['StartTime'] = $startTime;

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
