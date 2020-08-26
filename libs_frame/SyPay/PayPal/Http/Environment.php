<?php
namespace SyPay\PayPal\Http;

/**
 * Interface Environment
 *
 * @package SyPay\PayPal\Http
 * Describes a domain that hosts a REST API, against which an HttpClient will make requests.
 *
 * @see HttpClient
 */
interface Environment
{
    /**
     * @return string
     */
    public function baseUrl();
}
