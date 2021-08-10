<?php

namespace AlibabaCloud\Client\Traits;

use Exception;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class MockTrait
 *
 * @package AlibabaCloud\Client\Request\Traits
 * @mixin Request
 */
trait MockTrait
{
    /**
     * @var array
     */
    private static $mockQueue = [];
    /**
     * @var MockHandler
     */
    private static $mock;

    /**
     * @param int                 $status
     * @param array|object|string $body
     */
    public static function mockResponse($status = 200, array $headers = [], $body = null)
    {
        if (\is_array($body) || \is_object($body)) {
            $body = json_encode($body);
        }

        self::$mockQueue[] = new Response($status, $headers, $body);
        self::createHandlerStack();
    }

    /**
     * @param string $message
     */
    public static function mockRequestException(
        $message,
        RequestInterface $request,
        ?ResponseInterface $response = null,
        ?Exception $previous = null,
        array $handlerContext = []
    )
    {
        self::$mockQueue[] = new RequestException($message, $request, $response, $previous, $handlerContext);

        self::createHandlerStack();
    }

    public static function cancelMock()
    {
        self::$mockQueue = [];
        self::$mock = null;
    }

    /**
     * @return bool
     */
    public static function hasMock()
    {
        return (bool)self::$mockQueue;
    }

    /**
     * @return MockHandler
     */
    public static function getMock()
    {
        return self::$mock;
    }

    private static function createHandlerStack()
    {
        self::$mock = new MockHandler(self::$mockQueue);
    }
}
