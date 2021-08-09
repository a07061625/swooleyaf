<?php

namespace AliOpen\Imm;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetVideoTask
 *
 * @method string getProject()
 * @method string getTaskId()
 * @method string getTaskType()
 */
class GetVideoTaskRequest extends RpcAcsRequest
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
        parent::__construct('imm', '2017-09-06', 'GetVideoTask', 'imm');
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
     * @param string $taskId
     *
     * @return $this
     */
    public function setTaskId($taskId)
    {
        $this->requestParameters['TaskId'] = $taskId;
        $this->queryParameters['TaskId'] = $taskId;

        return $this;
    }

    /**
     * @param string $taskType
     *
     * @return $this
     */
    public function setTaskType($taskType)
    {
        $this->requestParameters['TaskType'] = $taskType;
        $this->queryParameters['TaskType'] = $taskType;

        return $this;
    }
}
