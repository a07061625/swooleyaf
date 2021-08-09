<?php

namespace AliOpen\Imm;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteTagJob
 *
 * @method string getProject()
 * @method string getJobId()
 * @method string getClearIndexData()
 */
class DeleteTagJobRequest extends RpcAcsRequest
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
        parent::__construct('imm', '2017-09-06', 'DeleteTagJob', 'imm');
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
     * @param string $clearIndexData
     *
     * @return $this
     */
    public function setClearIndexData($clearIndexData)
    {
        $this->requestParameters['ClearIndexData'] = $clearIndexData;
        $this->queryParameters['ClearIndexData'] = $clearIndexData;

        return $this;
    }
}
