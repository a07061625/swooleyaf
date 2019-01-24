<?php
namespace AliOss\Result;

class HeaderResult extends Result {
    /**
     * The returned ResponseCore header is used as the return data
     * @return array
     */
    protected function parseDataFromResponse(){
        return empty($this->rawResponse->header) ? [] : $this->rawResponse->header;
    }
}