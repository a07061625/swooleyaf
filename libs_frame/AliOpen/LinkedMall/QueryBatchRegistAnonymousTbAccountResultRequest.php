<?php

namespace AliOpen\LinkedMall;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryBatchRegistAnonymousTbAccountResult
 *
 * @method string getBizId()
 * @method string getBatchId()
 */
class QueryBatchRegistAnonymousTbAccountResultRequest extends RpcAcsRequest
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
        parent::__construct('linkedmall', '2018-01-16', 'QueryBatchRegistAnonymousTbAccountResult', 'linkedmall');
    }

    /**
     * @param string $bizId
     *
     * @return $this
     */
    public function setBizId($bizId)
    {
        $this->requestParameters['BizId'] = $bizId;
        $this->queryParameters['BizId'] = $bizId;

        return $this;
    }

    /**
     * @param string $batchId
     *
     * @return $this
     */
    public function setBatchId($batchId)
    {
        $this->requestParameters['BatchId'] = $batchId;
        $this->queryParameters['BatchId'] = $batchId;

        return $this;
    }
}
