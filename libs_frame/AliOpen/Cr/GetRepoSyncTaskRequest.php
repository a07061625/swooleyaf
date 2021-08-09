<?php

namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetRepoSyncTask
 *
 * @method string getSyncTaskId()
 * @method string getInstanceId()
 */
class GetRepoSyncTaskRequest extends RpcAcsRequest
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
            'cr',
            '2018-12-01',
            'GetRepoSyncTask',
            'acr'
        );
    }

    /**
     * @param string $syncTaskId
     *
     * @return $this
     */
    public function setSyncTaskId($syncTaskId)
    {
        $this->requestParameters['SyncTaskId'] = $syncTaskId;
        $this->queryParameters['SyncTaskId'] = $syncTaskId;

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
}
