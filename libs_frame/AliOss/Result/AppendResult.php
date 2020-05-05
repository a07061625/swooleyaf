<?php
namespace AliOss\Result;

use AliOss\Core\OssException;

/**
 * Class AppendResult
 * @package AliOss\Result
 */
class AppendResult extends Result
{
    /**
     * Get the value of next-append-position from append's response headers
     * @return int
     * @throws \AliOss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $header = $this->rawResponse->header;
        if (isset($header["x-oss-next-append-position"])) {
            return intval($header["x-oss-next-append-position"]);
        }
        throw new OssException("cannot get next-append-position");
    }
}