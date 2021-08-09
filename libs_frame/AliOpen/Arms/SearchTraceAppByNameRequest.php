<?php

namespace AliOpen\Arms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SearchTraceAppByName
 *
 * @method string getTraceAppName()
 */
class SearchTraceAppByNameRequest extends RpcAcsRequest
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
            'ARMS',
            '2019-08-08',
            'SearchTraceAppByName',
            'arms'
        );
    }

    /**
     * @param string $traceAppName
     *
     * @return $this
     */
    public function setTraceAppName($traceAppName)
    {
        $this->requestParameters['TraceAppName'] = $traceAppName;
        $this->queryParameters['TraceAppName'] = $traceAppName;

        return $this;
    }
}
