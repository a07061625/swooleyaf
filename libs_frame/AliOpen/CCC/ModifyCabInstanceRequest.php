<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyCabInstance
 *
 * @method string getMaxConcurrentConversation()
 * @method string getInstanceId()
 * @method string getInstanceName()
 * @method string getCallCenterInstanceId()
 * @method string getInstanceDescription()
 */
class ModifyCabInstanceRequest extends RpcAcsRequest
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
            'CCC',
            '2017-07-05',
            'ModifyCabInstance',
            'CCC'
        );
    }

    /**
     * @param string $maxConcurrentConversation
     *
     * @return $this
     */
    public function setMaxConcurrentConversation($maxConcurrentConversation)
    {
        $this->requestParameters['MaxConcurrentConversation'] = $maxConcurrentConversation;
        $this->queryParameters['MaxConcurrentConversation'] = $maxConcurrentConversation;

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
     * @param string $instanceName
     *
     * @return $this
     */
    public function setInstanceName($instanceName)
    {
        $this->requestParameters['InstanceName'] = $instanceName;
        $this->queryParameters['InstanceName'] = $instanceName;

        return $this;
    }

    /**
     * @param string $callCenterInstanceId
     *
     * @return $this
     */
    public function setCallCenterInstanceId($callCenterInstanceId)
    {
        $this->requestParameters['CallCenterInstanceId'] = $callCenterInstanceId;
        $this->queryParameters['CallCenterInstanceId'] = $callCenterInstanceId;

        return $this;
    }

    /**
     * @param string $instanceDescription
     *
     * @return $this
     */
    public function setInstanceDescription($instanceDescription)
    {
        $this->requestParameters['InstanceDescription'] = $instanceDescription;
        $this->queryParameters['InstanceDescription'] = $instanceDescription;

        return $this;
    }
}
