<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeMonitorGroupDynamicRules
 *
 * @method string getGroupId()
 */
class DescribeMonitorGroupDynamicRulesRequest extends RpcAcsRequest
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
            'DescribeMonitorGroupDynamicRules',
            'cms'
        );
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