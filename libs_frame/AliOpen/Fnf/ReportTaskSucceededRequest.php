<?php

namespace AliOpen\Fnf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ReportTaskSucceeded
 *
 * @method string getOutput()
 * @method string getRequestId()
 * @method string getTaskToken()
 */
class ReportTaskSucceededRequest extends RpcAcsRequest
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
        parent::__construct('fnf', '2019-03-15', 'ReportTaskSucceeded', 'fnf');
    }

    /**
     * @param string $output
     *
     * @return $this
     */
    public function setOutput($output)
    {
        $this->requestParameters['Output'] = $output;
        $this->queryParameters['Output'] = $output;

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
     * @param string $taskToken
     *
     * @return $this
     */
    public function setTaskToken($taskToken)
    {
        $this->requestParameters['TaskToken'] = $taskToken;
        $this->queryParameters['TaskToken'] = $taskToken;

        return $this;
    }
}
