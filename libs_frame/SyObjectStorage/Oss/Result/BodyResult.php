<?php
namespace SyObjectStorage\Oss\Result;

/**
 * Class BodyResult
 * @package SyObjectStorage\Oss\Result
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