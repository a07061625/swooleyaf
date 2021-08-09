<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeMonitoringAgentStatuses
 *
 * @method string getInstanceIds()
 */
class DescribeMonitoringAgentStatusesRequest extends RpcAcsRequest
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
            'DescribeMonitoringAgentStatuses',
            'cms'
        );
    }

    /**
     * @param string $instanceIds
     *
     * @return $this
     */
    public function setInstanceIds($instanceIds)
    {
        $this->requestParameters['InstanceIds'] = $instanceIds;
        $this->queryParameters['InstanceIds'] = $instanceIds;

        return $this;
    }
}
