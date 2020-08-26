<?php
namespace SyPay\PayPal\Http;

/**
 * Class HttpRequest
 *
 * @package SyPay\PayPal\Http
 * Request object that holds all the necessary information required by HTTPClient
 *
 * @see \SyPay\PayPal\Http\HttpClient
 */
class HttpRequest
{
    /**
     * @var string
     */
    public $path;

    /**
     * @var array | string
     */
    public $body;

    /**
     * @var string
     */
    public $verb;

    /**
     * @var array
     */
    public $headers;

    public function __construct($path, $verb)
    {
        $this->path = $path;
        $this->verb = $verb;
        $this->body = null;
        $this->headers = [];
    }
}
