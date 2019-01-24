<?php
namespace AliOss\Result;

use AliOss\Core\OssException;
use AliOss\OssClient;

class SymlinkResult extends Result {
    /**
     * @return string
     * @throws OssException
     */
    protected function parseDataFromResponse(){
        $this->rawResponse->header[OssClient::OSS_SYMLINK_TARGET] = rawurldecode($this->rawResponse->header[OssClient::OSS_SYMLINK_TARGET]);

        return $this->rawResponse->header;
    }
}

