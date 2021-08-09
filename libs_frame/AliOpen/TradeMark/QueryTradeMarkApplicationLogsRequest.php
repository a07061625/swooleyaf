<?php

namespace AliOpen\TradeMark;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryTradeMarkApplicationLogs
 *
 * @method string getBizId()
 */
class QueryTradeMarkApplicationLogsRequest extends RpcAcsRequest
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
        parent::__construct('Trademark', '2018-07-24', 'QueryTradeMarkApplicationLogs', 'trademark');
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
}
