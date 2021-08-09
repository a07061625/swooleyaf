<?php
namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of DeleteRepoSyncRule
 *
 * @method string getInstanceId()
 * @method string getSyncRuleId()
 */
class DeleteRepoSyncRuleRequest extends RpcAcsRequest
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
            'DeleteRepoSyncRule',
            'acr'
        );
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
