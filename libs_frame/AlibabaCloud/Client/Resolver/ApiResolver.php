<?php

namespace AlibabaCloud\Client\Resolver;

use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Request\Request;
use ReflectionObject;

/**
 * Class ApiResolver
 *
 * @codeCoverageIgnore
 *
 * @package AlibabaCloud\Client\Resolver
 */
abstract class ApiResolver
{
    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return (new static())->__call($name, $arguments);
    }

    /**
     * @param $api
     * @param $arguments
     *
     * @return mixed
     *
     * @throws ClientException
     */
    public function __call($api, $arguments)
    {
        $product_name = $this->getProductName();
        $class = $this->getNamespace() . '\\' . ucfirst($api);

        if (class_exists($class)) {
            if (isset($arguments[0])) {
                return $this->warpEndpoint(new $class($arguments[0]));
            }

            return $this->warpEndpoint(new $class());
        }

        throw new ClientException("{$product_name} contains no {$api}", 'SDK.ApiNotFound');
    }

    /**
     * @return Request
     */
    public function warpEndpoint(Request $request)
    {
        $reflect = new ReflectionObject($request);
        $product_dir = \dirname($reflect->getFileName());
        $endpoints_json = "{$product_dir}/endpoints.json";
        if (file_exists($endpoints_json)) {
            $endpoints = json_decode(file_get_contents($endpoints_json), true);
            if (isset($endpoints['endpoint_map'])) {
                $request->endpointMap = $endpoints['endpoint_map'];
            }
            if (isset($endpoints['endpoint_regional'])) {
                $request->endpointRegional = $endpoints['endpoint_regional'];
            }
        }

        return $request;
    }

    /**
     * @return mixed
     *
     * @throws ClientException
     */
    private function getProductName()
    {
        $array = explode('\\', static::class);
        if (isset($array[3])) {
            return str_replace('ApiResolver', '', $array[3]);
        }

        throw new ClientException('Service name not found.', 'SDK.ServiceNotFound');
    }

    /**
     * @return string
     *
     * @throws ClientException
     */
    private function getNamespace()
    {
        $array = explode('\\', static::class);

        if (!isset($array[3])) {
            throw new ClientException('Get namespace error.', 'SDK.ParseError');
        }

        unset($array[3]);

        return implode('\\', $array);
    }
}
