<?php

namespace AliOpen\Ivision;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeTrainDatas
 *
 * @method string getNextPageToken()
 * @method string getTagStatus()
 * @method string getPageSize()
 * @method string getProjectId()
 * @method string getShowLog()
 * @method string getTagId()
 * @method string getCurrentPage()
 * @method string getOwnerId()
 * @method string getIterationId()
 */
class DescribeTrainDatasRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('ivision', '2019-03-08', 'DescribeTrainDatas', 'ivision');
    }

    /**
     * @param string $nextPageToken
     *
     * @return $this
     */
    public function setNextPageToken($nextPageToken)
    {
        $this->requestParameters['NextPageToken'] = $nextPageToken;
        $this->queryParameters['NextPageToken'] = $nextPageToken;

        return $this;
    }

    /**
     * @param string $tagStatus
     *
     * @return $this
     */
    public function setTagStatus($tagStatus)
    {
        $this->requestParameters['TagStatus'] = $tagStatus;
        $this->queryParameters['TagStatus'] = $tagStatus;

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
     * @param string $projectId
     *
     * @return $this
     */
    public function setProjectId($projectId)
    {
        $this->requestParameters['ProjectId'] = $projectId;
        $this->queryParameters['ProjectId'] = $projectId;

        return $this;
    }

    /**
     * @param string $showLog
     *
     * @return $this
     */
    public function setShowLog($showLog)
    {
        $this->requestParameters['ShowLog'] = $showLog;
        $this->queryParameters['ShowLog'] = $showLog;

        return $this;
    }

    /**
     * @param string $tagId
     *
     * @return $this
     */
    public function setTagId($tagId)
    {
        $this->requestParameters['TagId'] = $tagId;
        $this->queryParameters['TagId'] = $tagId;

        return $this;
    }

    /**
     * @param string $currentPage
     *
     * @return $this
     */
    public function setCurrentPage($currentPage)
    {
        $this->requestParameters['CurrentPage'] = $currentPage;
        $this->queryParameters['CurrentPage'] = $currentPage;

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
     * @param string $iterationId
     *
     * @return $this
     */
    public function setIterationId($iterationId)
    {
        $this->requestParameters['IterationId'] = $iterationId;
        $this->queryParameters['IterationId'] = $iterationId;

        return $this;
    }
}
