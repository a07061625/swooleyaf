<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OnsTraceGetResult
 * @method string getQueryId()
 */
class TraceGetResultRequest extends RpcAcsRequest
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
        parent::__construct('Ons', '2019-02-14', 'OnsTraceGetResult', 'ons');
    }

    /**
     * @param string $queryId
     * @return $this
     */
    public function setQueryId($queryId)
    {
        $this->requestParameters['QueryId'] = $queryId;
        $this->queryParameters['QueryId'] = $queryId;

        return $this;
    }
}
