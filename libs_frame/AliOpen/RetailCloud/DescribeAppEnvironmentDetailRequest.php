<?php

namespace AliOpen\RetailCloud;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeAppEnvironmentDetail
 *
 * @method string getAppId()
 * @method string getEnvId()
 */
class DescribeAppEnvironmentDetailRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('retailcloud', '2018-03-13', 'DescribeAppEnvironmentDetail', 'retailcloud');
    }

    /**
     * @param string $appId
     *
     * @return $this
     */
    public function setAppId($appId)
    {
        $this->requestParameters['AppId'] = $appId;
        $this->queryParameters['AppId'] = $appId;

        return $this;
    }

    /**
     * @param string $envId
     *
     * @return $this
     */
    public function setEnvId($envId)
    {
        $this->requestParameters['EnvId'] = $envId;
        $this->queryParameters['EnvId'] = $envId;

        return $this;
    }
}
