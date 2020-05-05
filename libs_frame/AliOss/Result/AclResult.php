<?php
namespace AliOss\Result;

use AliOss\Core\OssException;

/**
 * The type of the return value of getBucketAcl, it wraps the data parsed from xml.
 * @package AliOss\Result
 */
class AclResult extends Result
{
    /**
     * @return string
     * @throws \AliOss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        if (empty($content)) {
            throw new OssException("body is null");
        }
        $xml = simplexml_load_string($content);
        if (isset($xml->AccessControlList->Grant)) {
            return strval($xml->AccessControlList->Grant);
        } else {
            throw new OssException("xml format exception");
        }
    }
}