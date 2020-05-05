<?php
namespace AliOss\Result;

/**
 * Class BodyResult
 * @package AliOss\Result
 */
class BodyResult extends Result
{
    /**
     * @return string
     */
    protected function parseDataFromResponse()
    {
        return empty($this->rawResponse->body) ? "" : $this->rawResponse->body;
    }
}