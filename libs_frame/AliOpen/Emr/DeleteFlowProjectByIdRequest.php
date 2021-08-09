<?php
namespace AliOpen\Emr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteFlowProjectById
 * @method string getProjectId()
 */
class DeleteFlowProjectByIdRequest extends RpcAcsRequest
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
        parent::__construct('Emr', '2016-04-08', 'DeleteFlowProjectById', 'emr');
    }

    /**
     * @param string $projectId
     * @return $this
     */
    public function setProjectId($projectId)
    {
        $this->requestParameters['ProjectId'] = $projectId;
        $this->queryParameters['ProjectId'] = $projectId;

        return $this;
    }
}
