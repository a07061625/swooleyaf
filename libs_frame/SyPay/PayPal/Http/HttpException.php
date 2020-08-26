<?php
namespace SyPay\PayPal\Http;

class HttpException extends IOException
{
    /**
     * @var int
     */
    public $statusCode;

    public $headers;

    /**
     * HttpException constructor.
     *
     * @param string $message
     * @param int    $statusCode
     * @param array  $headers
     */
    public function __construct($message, $statusCode, $headers)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }
}
