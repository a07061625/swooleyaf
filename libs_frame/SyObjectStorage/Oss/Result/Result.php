<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Core\OssException;
use SyObjectStorage\Oss\Http\ResponseCore;

/**
 * Class Result, The result class of The operation of the base class, different requests in dealing with the return of data have different logic,
 * The specific parsing logic postponed to subclass implementation
 *
 * @package SyObjectStorage\Oss\Result
 */
abstract class Result
{
    /**
     * Indicate whether the request is successful
     */
    protected $isOk = false;
    /**
     * Data parsed by subclasses
     */
    protected $parsedData;
    /**
     * Store the original Response returned by the auth function
     *
     * @var ResponseCore
     */
    protected $rawResponse;

    /**
     * Result constructor.
     *
     * @param $response ResponseCore
     *
     * @throws OssException
     */
    public function __construct($response)
    {
        if (null === $response) {
            throw new OssException('raw response is null');
        }
        $this->rawResponse = $response;
        $this->parseResponse();
    }

    /**
     * Get requestId
     *
     * @return string
     */
    public function getRequestId()
    {
        if (isset($this->rawResponse, $this->rawResponse->header, $this->rawResponse->header['x-oss-request-id'])
             ) {
            return $this->rawResponse->header['x-oss-request-id'];
        }

        return '';
    }

    /**
     * Get the returned data, different request returns the data format is different
     * $return mixed
     */
    public function getData()
    {
        return $this->parsedData;
    }

    /**
     * Whether the operation is successful
     *
     * @return mixed
     */
    public function isOK()
    {
        return $this->isOk;
    }

    /**
     * @throws OssException
     */
    public function parseResponse()
    {
        $this->isOk = $this->isResponseOk();
        if ($this->isOk) {
            $this->parsedData = $this->parseDataFromResponse();
        } else {
            $httpStatus = (string)($this->rawResponse->status);
            $requestId = (string)($this->getRequestId());
            $code = $this->retrieveErrorCode($this->rawResponse->body);
            $message = $this->retrieveErrorMessage($this->rawResponse->body);
            $body = $this->rawResponse->body;

            $details = [
                'status' => $httpStatus,
                'request-id' => $requestId,
                'code' => $code,
                'message' => $message,
                'body' => $body,
            ];

            throw new OssException($details);
        }
    }

    /**
     * Return the original return data
     *
     * @return ResponseCore
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }

    /**
     * Subclass implementation, different requests return data has different analytical logic, implemented by subclasses
     *
     * @return mixed
     */
    abstract protected function parseDataFromResponse();

    /**
     * Judging from the return http status code, [200-299] that is OK
     *
     * @return bool
     */
    protected function isResponseOk()
    {
        $status = $this->rawResponse->status;
        if (2 == (int)((int)$status / 100)) {
            return true;
        }

        return false;
    }

    /**
     * Try to get the error message from body
     *
     * @param $body
     *
     * @return string
     */
    private function retrieveErrorMessage($body)
    {
        if (empty($body) || false === strpos($body, '<?xml')) {
            return '';
        }
        $xml = simplexml_load_string($body);
        if (isset($xml->Message)) {
            return (string)($xml->Message);
        }

        return '';
    }

    /**
     * Try to get the error Code from body
     *
     * @param $body
     *
     * @return string
     */
    private function retrieveErrorCode($body)
    {
        if (empty($body) || false === strpos($body, '<?xml')) {
            return '';
        }
        $xml = simplexml_load_string($body);
        if (isset($xml->Code)) {
            return (string)($xml->Code);
        }

        return '';
    }
}
