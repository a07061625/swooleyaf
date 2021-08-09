<?php

namespace AliOpen\Imm;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetImageJob
 *
 * @method string getProject()
 * @method string getJobId()
 * @method string getJobType()
 */
class GetImageJobRequest extends RpcAcsRequest
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
        parent::__construct('imm', '2017-09-06', 'GetImageJob', 'imm');
    }

    /**
     * @param string $project
     *
     * @return $this
     */
    public function setProject($project)
    {
        $this->requestParameters['Project'] = $project;
        $this->queryParameters['Project'] = $project;

        return $this;
    }

    /**
     * @param string $jobId
     *
     * @return $this
     */
    public function setJobId($jobId)
    {
        $this->requestParameters['JobId'] = $jobId;
        $this->queryParameters['JobId'] = $jobId;

        return $this;
    }

    /**
     * @param string $jobType
     *
     * @return $this
     */
    public function setJobType($jobType)
    {
        $this->requestParameters['JobType'] = $jobType;
        $this->queryParameters['JobType'] = $jobType;

        return $this;
    }
}
