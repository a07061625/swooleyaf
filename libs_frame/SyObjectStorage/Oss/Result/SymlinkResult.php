<?php
namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Core\OssException;
use SyObjectStorage\Oss\OssClient;

/**
 * @package SyObjectStorage\Oss\Result
 */
class SymlinkResult extends Result
{
    /**
     * @return string
     * @throws \SyObjectStorage\Oss\Core\OssException
     */
    protected function parseDataFromResponse()
    {
        $this->rawResponse->header[OssClient::OSS_SYMLINK_TARGET] = rawurldecode($this->rawResponse->header[OssClient::OSS_SYMLINK_TARGET]);

        return $this->rawResponse->header;
    }
}
