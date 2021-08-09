<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\CorsConfig;

class GetCorsResult extends Result
{
    /**
     * @return CorsConfig
     *
     * @throws \SyObjectStorage\Oss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $config = new CorsConfig();
        $config->parseFromXml($content);

        return $config;
    }

    /**
     * Check if the response is OK, according to the http status. [200-299]:OK, the Cors config could be got; [404]: not found--no Cors config.
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
