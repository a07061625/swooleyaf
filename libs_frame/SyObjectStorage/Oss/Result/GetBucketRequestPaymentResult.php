<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\RequestPaymentConfig;

/**
 * Class GetBucketRequestPaymentResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class GetBucketRequestPaymentResult extends Result
{
    /**
     * Parse the RequestPaymentConfig object from the response
     *
     * @return RequestPaymentConfig
     *
     * @throws \SyObjectStorage\Oss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $config = new RequestPaymentConfig();
        $config->parseFromXml($content);

        return $config->getPayer();
    }
}
