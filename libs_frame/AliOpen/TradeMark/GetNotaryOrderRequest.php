<?php

namespace AliOpen\TradeMark;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetNotaryOrder
 * @method string getNotaryOrderId()
 */
class GetNotaryOrderRequest extends RpcAcsRequest
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
        parent::__construct('Trademark', '2018-07-24', 'GetNotaryOrder', 'trademark');
    }

    /**
     * @param string $notaryOrderId
     * @return $this
     */
    public function setNotaryOrderId($notaryOrderId)
    {
        $this->requestParameters['NotaryOrderId'] = $notaryOrderId;
        $this->queryParameters['NotaryOrderId'] = $notaryOrderId;

        return $this;
    }
}
