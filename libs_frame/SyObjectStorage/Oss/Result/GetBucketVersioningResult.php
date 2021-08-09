<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\VersioningConfig;

/**
 * Class GetBucketVersioningResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class GetBucketVersioningResult extends Result
{
    /**
     * Parse the VersioningConfig object from the response
     *
     * @return VersioningConfig
     *
     * @throws \SyObjectStorage\Oss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $config = new VersioningConfig();
        $config->parseFromXml($content);

        return $config->getStatus();
    }
}
