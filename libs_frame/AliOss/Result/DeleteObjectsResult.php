<?php
namespace AliOss\Result;

/**
 * Class DeleteObjectsResult
 * @package AliOss\Result
 */
class DeleteObjectsResult extends Result
{
    /**
     * @return array
     */
    protected function parseDataFromResponse()
    {
        $body = $this->rawResponse->body;
        $xml = simplexml_load_string($body);
        $objects = [];

        if (isset($xml->Deleted)) {
            foreach ($xml->Deleted as $deleteKey) {
                $objects[] = $deleteKey->Key;
            }
        }

        return $objects;
    }
}
