<?php

namespace AliOpen\RetailCloud;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribePodEvents
 * @method string getDeployOrderId()
 * @method string getAppInstId()
 */
class DescribePodEventsRequest extends RpcAcsRequest
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
        parent::__construct('retailcloud', '2018-03-13', 'DescribePodEvents', 'retailcloud');
    }

    /**
     * @param string $deployOrderId
     * @return $this
     */
    public function setDeployOrderId($deployOrderId)
    {
        $this->requestParameters['DeployOrderId'] = $deployOrderId;
        $this->queryParameters['DeployOrderId'] = $deployOrderId;

        return $this;
    }

    /**
     * @param string $appInstId
     * @return $this
     */
    public function setAppInstId($appInstId)
    {
        $this->requestParameters['AppInstId'] = $appInstId;
        $this->queryParameters['AppInstId'] = $appInstId;

        return $this;
    }
}
