<?php

namespace SyObjectStorage\Oss\Result;

/**
 * Class CopyObjectResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class CopyObjectResult extends Result
{
    /**
     * @return array()
     */
    protected function parseDataFromResponse()
    {
        $body = $this->rawResponse->body;
        $xml = simplexml_load_string($body);
        $result = [];

        if (isset($xml->LastModified)) {
            $result[] = $xml->LastModified;
        }
        if (isset($xml->ETag)) {
            $result[] = $xml->ETag;
        }

        return array_merge($result, $this->rawResponse->header);
    }
}
