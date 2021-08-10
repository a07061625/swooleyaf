<?php

namespace AlibabaCloud\Client\Traits;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Filter\Filter;
use AlibabaCloud\Client\Request\RoaRequest;
use AlibabaCloud\Client\Request\RpcRequest;
use AlibabaCloud\Client\Request\UserAgent;

/**
 * Trait RequestTrait
 *
 * @package   AlibabaCloud\Client\Traits
 * @mixin     AlibabaCloud
 */
trait RequestTrait
{
    /**
     * @param string $name
     * @param string $value
     *
     * @throws ClientException
     */
    public static function appendUserAgent($name, $value)
    {
        Filter::name($name);
        Filter::value($value);

        UserAgent::append($name, $value);
    }

    public static function withUserAgent(array $userAgent)
    {
        UserAgent::with($userAgent);
    }

    /**
     * @return RpcRequest
     *
     * @throws ClientException
     *
     * @deprecated
     * @codeCoverageIgnore
     */
    public static function rpcRequest(array $options = [])
    {
        return self::rpc($options);
    }

    /**
     * @return RpcRequest
     *
     * @throws ClientException
     */
    public static function rpc(array $options = [])
    {
        return new RpcRequest($options);
    }

    /**
     * @return RoaRequest
     *
     * @throws ClientException
     *
     * @deprecated
     * @codeCoverageIgnore
     */
    public static function roaRequest(array $options = [])
    {
        return self::roa($options);
    }

    /**
     * @return RoaRequest
     *
     * @throws ClientException
     */
    public static function roa(array $options = [])
    {
        return new RoaRequest($options);
    }
}
