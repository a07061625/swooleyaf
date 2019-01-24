<?php
namespace AliOss\Result;

use AliOss\Core\OssException;

class GetLocationResult extends Result {
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

        return $xml;
    }
}