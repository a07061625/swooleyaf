<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\WormConfig;

/**
 * Class GetBucketWormResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class GetBucketWormResult extends Result
{
    /**
     * Parse bucket stat data
     *
     * @return WormConfig
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $config = new WormConfig();
        $config->parseFromXml($content);

        return $config;
    }
}
