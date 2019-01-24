<?php
namespace AliOss\Result;

use AliOss\Core\OssException;

class AclResult extends Result {
    /**
     * @return string
     * @throws OssException
     */
    protected function parseDataFromResponse(){
        $content = $this->rawResponse->body;
        if (empty($content)) {
            throw new OssException("body is null");
        }
        $xml = simplexml_load_string($content);
        if (isset($xml->AccessControlList->Grant)) {
            return strval($xml->AccessControlList->Grant);
        } else {
            throw new OssException("xml format exception");
        }
    }
}