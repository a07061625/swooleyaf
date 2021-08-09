<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\LoggingConfig;

/**
 * Class GetLoggingResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class GetLoggingResult extends Result
{
    /**
     * Parse LoggingConfig data
     *
     * @return LoggingConfig
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $config = new LoggingConfig();
        $config->parseFromXml($content);

        return $config;
    }

    /**
     * Judged according to the return HTTP status code, [200-299] that is OK, get the bucket configuration interface,
     * 404 is also considered a valid response
     *
     * @return bool
     */
    protected function isResponseOk()
    {
        $status = $this->rawResponse->status;
        if (2 == (int)((int)$status / 100) || 404 === (int)((int)$status)) {
            return true;
        }

        return false;
    }
}
