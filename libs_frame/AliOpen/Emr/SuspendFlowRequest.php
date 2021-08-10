<?php

namespace AliOpen\Emr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SuspendFlow
 *
 * @method string getFlowInstanceId()
 * @method string getProjectId()
 */
class SuspendFlowRequest extends RpcAcsRequest
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
        parent::__construct('Emr', '2016-04-08', 'SuspendFlow', 'emr');
    }

    /**
     * @param string $flowInstanceId
     *
     * @return $this
     */
    public function setFlowInstanceId($flowInstanceId)
    {
        $this->requestParameters['FlowInstanceId'] = $flowInstanceId;
        $this->queryParameters['FlowInstanceId'] = $flowInstanceId;

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
}