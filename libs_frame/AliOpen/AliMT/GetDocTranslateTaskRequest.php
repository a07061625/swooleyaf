<?php

namespace AliOpen\AliMT;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetDocTranslateTask
 *
 * @method string getTaskId()
 */
class GetDocTranslateTaskRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'alimt',
            '2018-10-12',
            'GetDocTranslateTask',
            'alimt'
        );
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
}
