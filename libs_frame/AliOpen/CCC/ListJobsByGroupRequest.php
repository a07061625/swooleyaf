<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListJobsByGroup
 *
 * @method string getJobStatus()
 * @method string getPageNumber()
 * @method string getInstanceId()
 * @method string getJobFailureReason()
 * @method string getJobGroupId()
 * @method string getPageSize()
 */
class ListJobsByGroupRequest extends RpcAcsRequest
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
            'CCC',
            '2017-07-05',
            'ListJobsByGroup',
            'CCC'
        );
    }

    /**
     * @param string $jobStatus
     *
     * @return $this
     */
    public function setJobStatus($jobStatus)
    {
        $this->requestParameters['JobStatus'] = $jobStatus;
        $this->queryParameters['JobStatus'] = $jobStatus;

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
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }

    /**
     * @param string $jobFailureReason
     *
     * @return $this
     */
    public function setJobFailureReason($jobFailureReason)
    {
        $this->requestParameters['JobFailureReason'] = $jobFailureReason;
        $this->queryParameters['JobFailureReason'] = $jobFailureReason;

        return $this;
    }

    /**
     * @param string $jobGroupId
     *
     * @return $this
     */
    public function setJobGroupId($jobGroupId)
    {
        $this->requestParameters['JobGroupId'] = $jobGroupId;
        $this->queryParameters['JobGroupId'] = $jobGroupId;

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
}
