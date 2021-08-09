<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\TaggingConfig;

/**
 * Class GetBucketTagsResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class GetBucketTagsResult extends Result
{
    /**
     * Parse the TaggingConfig object from the response
     *
     * @return TaggingConfig
     *
     * @throws \SyObjectStorage\Oss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $config = new TaggingConfig();
        $config->parseFromXml($content);

        return $config;
    }
}
