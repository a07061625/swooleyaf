<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class AppendResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class AppendResult extends Result
{
    /**
     * Get the value of next-append-position from append's response headers
     *
     * @return int
     *
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $header = $this->rawResponse->header;
        if (isset($header['x-oss-next-append-position'])) {
            return (int)($header['x-oss-next-append-position']);
        }

        throw new OssException('cannot get next-append-position');
    }
}
