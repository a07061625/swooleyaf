<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CeaseInstance
 *
 * @method string getTraceId()
 * @method string getSpMsg()
 */
class CeaseInstanceRequest extends RpcAcsRequest
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
            'cloudwf',
            '2017-03-28',
            'CeaseInstance',
            'cloudwf'
        );
    }

    /**
     * @param string $traceId
     *
     * @return $this
     */
    public function setTraceId($traceId)
    {
        $this->requestParameters['TraceId'] = $traceId;
        $this->queryParameters['TraceId'] = $traceId;

        return $this;
    }

    /**
     * @param string $spMsg
     *
     * @return $this
     */
    public function setSpMsg($spMsg)
    {
        $this->requestParameters['SpMsg'] = $spMsg;
        $this->queryParameters['SpMsg'] = $spMsg;

        return $this;
    }
}