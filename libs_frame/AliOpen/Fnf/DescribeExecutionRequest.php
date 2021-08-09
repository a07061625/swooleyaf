<?php

namespace AliOpen\Fnf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeExecution
 *
 * @method string getExecutionName()
 * @method string getRequestId()
 * @method string getFlowName()
 */
class DescribeExecutionRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('fnf', '2019-03-15', 'DescribeExecution', 'fnf');
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
