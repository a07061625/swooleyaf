<?php
namespace AliOss\Result;

use AliOss\Core\OssException;

class GetStorageCapacityResult extends Result {
    /**
     * Parse data from response
     * @return string
     * @throws OssException
     */
    protected function parseDataFromResponse(){
        $content = $this->rawResponse->body;
        if (empty($content)) {
            throw new OssException("body is null");
        }
        $xml = simplexml_load_string($content);
        if (isset($xml->StorageCapacity)) {
            return intval($xml->StorageCapacity);
        } else {
            throw new OssException("xml format exception");
        }
    }
}