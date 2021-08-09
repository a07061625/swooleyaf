<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Core\OssException;

/**
 * The type of the return value of getBucketAcl, it wraps the data parsed from xml.
 *
 * @package SyObjectStorage\Oss\Result
 */
class AclResult extends Result
{
    /**
     * @return string
     *
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        if (empty($content)) {
            throw new OssException('body is null');
        }
        $xml = simplexml_load_string($content);
        if (isset($xml->AccessControlList->Grant)) {
            return (string)($xml->AccessControlList->Grant);
        }

        throw new OssException('xml format exception');
    }
}
