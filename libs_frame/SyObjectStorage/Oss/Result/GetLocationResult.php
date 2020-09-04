<?php
namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class GetLocationResult getBucketLocation interface returns the result class, encapsulated
 * The returned xml data is parsed
 * @package SyObjectStorage\Oss\Result
 */
class GetLocationResult extends Result
{
    /**
     * Parse data from response
     * @return string
     * @throws \SyObjectStorage\Oss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        if (empty($content)) {
            throw new OssException("body is null");
        }
        $xml = simplexml_load_string($content);

        return $xml;
    }
}