<?php

namespace AliOpen\BssOpenApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryPrice
 *
 * @method string getParamStr()
 */
class QueryPriceRequest extends RpcAcsRequest
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
        parent::__construct('BssOpenApi', '2017-12-14', 'QueryPrice');
    }

    /**
     * @param string $paramStr
     *
     * @return $this
     */
    public function setParamStr($paramStr)
    {
        $this->requestParameters['ParamStr'] = $paramStr;
        $this->queryParameters['ParamStr'] = $paramStr;

        return $this;
    }
}
