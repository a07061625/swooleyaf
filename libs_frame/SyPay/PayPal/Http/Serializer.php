<?php
namespace SyPay\PayPal\Http;

/**
 * Interface Serializer
 *
 * @package SyPay\PayPal\Http
 * Used to implement different serializers for different content types
 */
interface Serializer
{
    /**
     * @return string regex that matches the content type it supports
     */
    public function contentType();

    /**
     * @param HttpRequest $request
     *
     * @return string representation of your data after being serialized
     */
    public function encode(HttpRequest $request);

    /**
     * @param $body
     *
     * @return mixed object/string representing the de-serialized response body
     */
    public function decode($body);
}
