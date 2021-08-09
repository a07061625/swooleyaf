<?php
namespace AliOpen\Domain;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of FailDemand
 * @method string getBizId()
 * @method string getMessage()
 */
class FailDemandRequest extends RpcAcsRequest
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
        parent::__construct('Domain', '2018-02-08', 'FailDemand');
    }

    /**
     * @param string $bizId
     * @return $this
     */
    public function setBizId($bizId)
    {
        $this->requestParameters['BizId'] = $bizId;
        $this->queryParameters['BizId'] = $bizId;

        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->requestParameters['Message'] = $message;
        $this->queryParameters['Message'] = $message;

        return $this;
    }
}
