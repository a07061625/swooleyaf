<?php
namespace SyPay\PayPal\Http;

/**
 * Class HttpResponse
 *
 * @package SyPay\PayPal\Http
 *
 * Object that holds your response details
 */
class HttpResponse
{
    /**
     * @var integer
     */
    public $statusCode;

    /**
     * @var array | string
     */
    public $result;

    /**
     * @var array
     */
    public $headers;

    public function __construct($statusCode, $body, $headers)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->result = $body;
    }
}
