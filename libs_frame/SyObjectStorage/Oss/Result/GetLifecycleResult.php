<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\LifecycleConfig;

/**
 * Class GetLifecycleResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class GetLifecycleResult extends Result
{
    /**
     * Parse the LifecycleConfig object from the response
     *
     * @return LifecycleConfig
     *
     * @throws \SyObjectStorage\Oss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $config = new LifecycleConfig();
        $config->parseFromXml($content);

        return $config;
    }

    /**
     * Check if the response is OK according to the http status.
     * [200-299]: OK, and the LifecycleConfig could be got; [404] The Life cycle config is not found.
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
