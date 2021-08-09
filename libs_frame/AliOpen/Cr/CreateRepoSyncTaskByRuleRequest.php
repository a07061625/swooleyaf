<?php

namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateRepoSyncTaskByRule
 *
 * @method string getRepoId()
 * @method string getInstanceId()
 * @method string getTag()
 * @method string getSyncRuleId()
 */
class CreateRepoSyncTaskByRuleRequest extends RpcAcsRequest
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
            'CreateRepoSyncTaskByRule',
            'acr'
        );
    }

    /**
     * @param string $repoId
     *
     * @return $this
     */
    public function setRepoId($repoId)
    {
        $this->requestParameters['RepoId'] = $repoId;
        $this->queryParameters['RepoId'] = $repoId;

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
     * @param string $tag
     *
     * @return $this
     */
    public function setTag($tag)
    {
        $this->requestParameters['Tag'] = $tag;
        $this->queryParameters['Tag'] = $tag;

        return $this;
    }

    /**
     * @param string $syncRuleId
     *
     * @return $this
     */
    public function setSyncRuleId($syncRuleId)
    {
        $this->requestParameters['SyncRuleId'] = $syncRuleId;
        $this->queryParameters['SyncRuleId'] = $syncRuleId;

        return $this;
    }
}
