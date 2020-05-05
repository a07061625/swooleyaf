<?php
namespace AliOss\Result;

/**
 * Class HeaderResult
 * @package AliOss\Result
 * @link https://docs.aliyun.com/?spm=5176.383663.13.7.HgUIqL#/pub/oss/api-reference/object&GetObjectMeta
 */
class HeaderResult extends Result
{
    /**
     * The returned ResponseCore header is used as the return data
     * @return array
     */
    protected function parseDataFromResponse()
    {
        return empty($this->rawResponse->header) ? [] : $this->rawResponse->header;
    }
}