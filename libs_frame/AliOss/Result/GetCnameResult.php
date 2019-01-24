<?php
namespace AliOss\Result;

use AliOss\Model\CnameConfig;

class GetCnameResult extends Result {
    /**
     * @return CnameConfig
     */
    protected function parseDataFromResponse(){
        $content = $this->rawResponse->body;
        $config = new CnameConfig();
        $config->parseFromXml($content);

        return $config;
    }
}