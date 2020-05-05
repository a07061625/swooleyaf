<?php
namespace AliOss\Result;

use AliOss\Core\OssException;

/**
 * Class UploadPartResult
 * @package AliOss\Result
 */
class UploadPartResult extends Result
{
    /**
     * 结果中part的ETag
     * @return string
     * @throws \AliOss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $header = $this->rawResponse->header;
        if (isset($header["etag"])) {
            return $header["etag"];
        }
        throw new OssException("cannot get ETag");
    }
}