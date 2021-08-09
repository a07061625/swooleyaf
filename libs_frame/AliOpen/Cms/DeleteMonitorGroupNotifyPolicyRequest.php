<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteMonitorGroupNotifyPolicy
 *
 * @method string getPolicyType()
 * @method string getGroupId()
 */
class DeleteMonitorGroupNotifyPolicyRequest extends RpcAcsRequest
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
            'Cms',
            '2019-01-01',
            'DeleteMonitorGroupNotifyPolicy',
            'cms'
        );
    }

    /**
     * @param string $policyType
     *
     * @return $this
     */
    public function setPolicyType($policyType)
    {
        $this->requestParameters['PolicyType'] = $policyType;
        $this->queryParameters['PolicyType'] = $policyType;

        return $this;
    }

    /**
     * @param string $groupId
     *
     * @return $this
     */
    public function setGroupId($groupId)
    {
        $this->requestParameters['GroupId'] = $groupId;
        $this->queryParameters['GroupId'] = $groupId;

        return $this;
    }
}
