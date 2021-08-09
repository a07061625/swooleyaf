<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class InitiateBucketWormResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class InitiateBucketWormResult extends Result
{
    /**
     * Get the value of worm-id from response headers
     *
     * @return int
     *
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $header = $this->rawResponse->header;
        if (isset($header['x-oss-worm-id'])) {
            return (string)($header['x-oss-worm-id']);
        }

        throw new OssException('cannot get worm-id');
    }
}
