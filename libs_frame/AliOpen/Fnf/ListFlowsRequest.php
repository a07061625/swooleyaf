<?php

namespace AliOpen\Fnf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListFlows
 *
 * @method string getNextToken()
 * @method string getRequestId()
 * @method string getLimit()
 */
class ListFlowsRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('fnf', '2019-03-15', 'ListFlows', 'fnf');
    }

    /**
     * @param string $nextToken
     *
     * @return $this
     */
    public function setNextToken($nextToken)
    {
        $this->requestParameters['NextToken'] = $nextToken;
        $this->queryParameters['NextToken'] = $nextToken;

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
     * @param string $limit
     *
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->requestParameters['Limit'] = $limit;
        $this->queryParameters['Limit'] = $limit;

        return $this;
    }
}
