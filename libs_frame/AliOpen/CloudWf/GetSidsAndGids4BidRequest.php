<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetSidsAndGids4Bid
 *
 * @method string getQueryType()
 * @method string getQueryId()
 */
class GetSidsAndGids4BidRequest extends RpcAcsRequest
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
            'GetSidsAndGids4Bid',
            'cloudwf'
        );
    }

    /**
     * @param string $queryType
     *
     * @return $this
     */
    public function setQueryType($queryType)
    {
        $this->requestParameters['QueryType'] = $queryType;
        $this->queryParameters['QueryType'] = $queryType;

        return $this;
    }

    /**
     * @param string $queryId
     *
     * @return $this
     */
    public function setQueryId($queryId)
    {
        $this->requestParameters['QueryId'] = $queryId;
        $this->queryParameters['QueryId'] = $queryId;

        return $this;
    }
}
