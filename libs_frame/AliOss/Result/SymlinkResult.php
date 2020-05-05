<?php
namespace AliOss\Result;

use AliOss\Core\OssException;
use AliOss\OssClient;

/**
 * @package AliOss\Result
 */
class SymlinkResult extends Result
{
    /**
     * @return string
     * @throws \AliOss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $this->rawResponse->header[OssClient::OSS_SYMLINK_TARGET] = rawurldecode($this->rawResponse->header[OssClient::OSS_SYMLINK_TARGET]);

        return $this->rawResponse->header;
    }
}
