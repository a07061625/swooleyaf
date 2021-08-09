<?php

namespace AliOpen\Fnf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of StopExecution
 *
 * @method string getExecutionName()
 * @method string getCause()
 * @method string getError()
 * @method string getRequestId()
 * @method string getFlowName()
 */
class StopExecutionRequest extends RpcAcsRequest
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
        parent::__construct('fnf', '2019-03-15', 'StopExecution', 'fnf');
    }

    /**
     * @param string $executionName
     *
     * @return $this
     */
    public function setExecutionName($executionName)
    {
        $this->requestParameters['ExecutionName'] = $executionName;
        $this->queryParameters['ExecutionName'] = $executionName;

        return $this;
    }

    /**
     * @param string $cause
     *
     * @return $this
     */
    public function setCause($cause)
    {
        $this->requestParameters['Cause'] = $cause;
        $this->queryParameters['Cause'] = $cause;

        return $this;
    }

    /**
     * @param string $error
     *
     * @return $this
     */
    public function setError($error)
    {
        $this->requestParameters['Error'] = $error;
        $this->queryParameters['Error'] = $error;

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
     * @param string $flowName
     *
     * @return $this
     */
    public function setFlowName($flowName)
    {
        $this->requestParameters['FlowName'] = $flowName;
        $this->queryParameters['FlowName'] = $flowName;

        return $this;
    }
}
