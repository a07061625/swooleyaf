<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of EnableSiteMonitors
 *
 * @method string getTaskIds()
 */
class EnableSiteMonitorsRequest extends RpcAcsRequest
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
            'EnableSiteMonitors',
            'cms'
        );
    }

    /**
     * @param string $taskIds
     *
     * @return $this
     */
    public function setTaskIds($taskIds)
    {
        $this->requestParameters['TaskIds'] = $taskIds;
        $this->queryParameters['TaskIds'] = $taskIds;

        return $this;
    }
}
