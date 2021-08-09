<?php

namespace AliOpen\Fnf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of UpdateFlow
 *
 * @method string getDescription()
 * @method string getType()
 * @method string getRequestId()
 * @method string getRoleArn()
 * @method string getName()
 * @method string getDefinition()
 */
class UpdateFlowRequest extends RpcAcsRequest
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
        parent::__construct('fnf', '2019-03-15', 'UpdateFlow', 'fnf');
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->requestParameters['Description'] = $description;
        $this->queryParameters['Description'] = $description;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->requestParameters['Type'] = $type;
        $this->queryParameters['Type'] = $type;

        return $this;
    }

    /**
     * @param string $requestId
     *
     * @return $this
     */
    public function setRequestId($requestId)
    {
        $this->requestParameters['RequestId'] = $requestId;
        $this->queryParameters['RequestId'] = $requestId;

        return $this;
    }

    /**
     * @param string $roleArn
     *
     * @return $this
     */
    public function setRoleArn($roleArn)
    {
        $this->requestParameters['RoleArn'] = $roleArn;
        $this->queryParameters['RoleArn'] = $roleArn;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }

    /**
     * @param string $definition
     *
     * @return $this
     */
    public function setDefinition($definition)
    {
        $this->requestParameters['Definition'] = $definition;
        $this->queryParameters['Definition'] = $definition;

        return $this;
    }
}
