<?php

namespace AliOpen\TradeMark;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of StartNotary
 * @method string getNotaryOrderId()
 */
class StartNotaryRequest extends RpcAcsRequest
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
        parent::__construct('Trademark', '2018-07-24', 'StartNotary', 'trademark');
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
