<?php
namespace AliOss\Result;

/**
 * Class PutSetDeleteResult
 * @package AliOss\Result
 */
class PutSetDeleteResult extends Result
{
    /**
     * @return array
     */
    protected function parseDataFromResponse()
    {
        $body = ['body' => $this->rawResponse->body];

        return array_merge($this->rawResponse->header, $body);
    }
}
