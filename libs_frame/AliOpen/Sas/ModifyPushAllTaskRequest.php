<?php

namespace AliOpen\Sas;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyPushAllTask
 *
 * @method string getSourceIp()
 * @method string getTasks()
 * @method string getUuids()
 */
class ModifyPushAllTaskRequest extends RpcAcsRequest
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
        parent::__construct('Sas', '2018-12-03', 'ModifyPushAllTask', 'sas');
    }

    /**
     * @param string $sourceIp
     *
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }

    /**
     * @param string $tasks
     *
     * @return $this
     */
    public function setTasks($tasks)
    {
        $this->requestParameters['Tasks'] = $tasks;
        $this->queryParameters['Tasks'] = $tasks;

        return $this;
    }

    /**
     * @param string $uuids
     *
     * @return $this
     */
    public function setUuids($uuids)
    {
        $this->requestParameters['Uuids'] = $uuids;
        $this->queryParameters['Uuids'] = $uuids;

        return $this;
    }
}
