<?php
namespace AliOss\Result;

use AliOss\Core\OssException;

class UploadPartResult extends Result {
    /**
     * 结果中part的ETag
     * @return string
     * @throws OssException
     */
    protected function parseDataFromResponse(){
        $header = $this->rawResponse->header;
        if (isset($header["etag"])) {
            return $header["etag"];
        }
        throw new OssException("cannot get ETag");
    }
}