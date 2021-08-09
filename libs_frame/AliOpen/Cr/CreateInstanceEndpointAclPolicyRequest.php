<?php

namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateInstanceEndpointAclPolicy
 *
 * @method string getEntry()
 * @method string getInstanceId()
 * @method string getEndpointType()
 * @method string getModuleName()
 * @method string getComment()
 */
class CreateInstanceEndpointAclPolicyRequest extends RpcAcsRequest
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
            'CreateInstanceEndpointAclPolicy',
            'acr'
        );
    }

    /**
     * @param string $entry
     *
     * @return $this
     */
    public function setEntry($entry)
    {
        $this->requestParameters['Entry'] = $entry;
        $this->queryParameters['Entry'] = $entry;

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
     * @param string $endpointType
     *
     * @return $this
     */
    public function setEndpointType($endpointType)
    {
        $this->requestParameters['EndpointType'] = $endpointType;
        $this->queryParameters['EndpointType'] = $endpointType;

        return $this;
    }

    /**
     * @param string $moduleName
     *
     * @return $this
     */
    public function setModuleName($moduleName)
    {
        $this->requestParameters['ModuleName'] = $moduleName;
        $this->queryParameters['ModuleName'] = $moduleName;

        return $this;
    }

    /**
     * @param string $comment
     *
     * @return $this
     */
    public function setComment($comment)
    {
        $this->requestParameters['Comment'] = $comment;
        $this->queryParameters['Comment'] = $comment;

        return $this;
    }
}
