<?php
namespace SyPay\PayPal\Http\Serializer;

use SyPay\PayPal\Http\HttpRequest;
use SyPay\PayPal\Http\Serializer;

/**
 * Class Text
 *
 * @package SyPay\PayPal\Http\Serializer
 *
 * Serializer for Text content types.
 */
class Text implements Serializer
{
    public function contentType()
    {
        return '/^text\\/.*/';
    }

    public function encode(HttpRequest $request)
    {
        $body = $request->body;
        if (is_string($body)) {
            return $body;
        }
        if (is_array($body)) {
            return json_encode($body);
        }

        return implode(' ', $body);
    }

    public function decode($data)
    {
        return $data;
    }
}
