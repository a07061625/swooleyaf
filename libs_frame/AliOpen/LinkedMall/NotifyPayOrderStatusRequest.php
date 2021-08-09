<?php

namespace AliOpen\LinkedMall;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of NotifyPayOrderStatus
 *
 * @method string getAmount()
 * @method string getPayTypes()
 * @method string getRequestId()
 * @method string getOperationDate()
 * @method string getChannelId()
 */
class NotifyPayOrderStatusRequest extends RpcAcsRequest
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
        parent::__construct('linkedmall', '2018-01-16', 'NotifyPayOrderStatus', 'linkedmall');
    }

    /**
     * @param string $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->requestParameters['Amount'] = $amount;
        $this->queryParameters['Amount'] = $amount;

        return $this;
    }

    /**
     * @param string $payTypes
     *
     * @return $this
     */
    public function setPayTypes($payTypes)
    {
        $this->requestParameters['PayTypes'] = $payTypes;
        $this->queryParameters['PayTypes'] = $payTypes;

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
     * @param string $operationDate
     *
     * @return $this
     */
    public function setOperationDate($operationDate)
    {
        $this->requestParameters['OperationDate'] = $operationDate;
        $this->queryParameters['OperationDate'] = $operationDate;

        return $this;
    }

    /**
     * @param string $channelId
     *
     * @return $this
     */
    public function setChannelId($channelId)
    {
        $this->requestParameters['ChannelId'] = $channelId;
        $this->queryParameters['ChannelId'] = $channelId;

        return $this;
    }
}
