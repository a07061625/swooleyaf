<?php

namespace AlibabaCloud\Client\Signature;

use AlibabaCloud\Client\Support\Sign;
use GuzzleHttp\Psr7\Request;

/**
 * Class Signature
 *
 * @package AlibabaCloud\Client\Signature
 */
abstract class Signature
{
    /**
     * @codeCoverageIgnore
     *
     * @param string $accessKeyId
     * @param string $accessKeySecret
     *
     * @return string
     */
    public function roa($accessKeyId, $accessKeySecret, Request $request)
    {
        $string = Sign::roaString($request);

        $signature = $this->sign($string, $accessKeySecret);

        return "acs {$accessKeyId}:{$signature}";
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $accessKeySecret
     * @param string $method
     *
     * @return string
     */
    public function rpc($accessKeySecret, $method, array $parameters)
    {
        $string = Sign::rpcString($method, $parameters);

        return $this->sign($string, $accessKeySecret . '&');
    }
}
