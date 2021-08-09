<?php

namespace AliOpen\RetailCloud;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ResumeDeploy
 *
 * @method string getDeployOrderId()
 */
class ResumeDeployRequest extends RpcAcsRequest
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
        parent::__construct('retailcloud', '2018-03-13', 'ResumeDeploy', 'retailcloud');
    }

    /**
     * @param string $deployOrderId
     *
     * @return $this
     */
    public function setDeployOrderId($deployOrderId)
    {
        $this->requestParameters['DeployOrderId'] = $deployOrderId;
        $this->queryParameters['DeployOrderId'] = $deployOrderId;

        return $this;
    }
}
