<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\OssClient;

/**
 * @package SyObjectStorage\Oss\Result
 */
class SymlinkResult extends Result
{
    /**
     * @return string
     */
    protected function parseDataFromResponse()
    {
        $this->rawResponse->header[OssClient::OSS_SYMLINK_TARGET] = rawurldecode($this->rawResponse->header[OssClient::OSS_SYMLINK_TARGET]);

        return $this->rawResponse->header;
    }
}
