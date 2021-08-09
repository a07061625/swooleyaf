<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\ServerSideEncryptionConfig;

/**
 * Class GetBucketEncryptionResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class GetBucketEncryptionResult extends Result
{
    /**
     * Parse the ServerSideEncryptionConfig object from the response
     *
     * @return ServerSideEncryptionConfig
     *
     * @throws \SyObjectStorage\Oss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $config = new ServerSideEncryptionConfig();
        $config->parseFromXml($content);

        return $config;
    }
}
