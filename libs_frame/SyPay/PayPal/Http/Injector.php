<?php
namespace SyPay\PayPal\Http;

/**
 * Interface Injector
 *
 * @package SyPay\PayPal\Http
 * Interface that can be implemented to apply injectors to Http client.
 *
 * @see \SyPay\PayPal\Http\HttpClient
 */
interface Injector
{
    /**
     * @param $httpRequest HttpRequest
     */
    public function inject($httpRequest);
}
