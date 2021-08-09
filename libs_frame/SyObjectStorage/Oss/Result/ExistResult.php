<?php

namespace SyObjectStorage\Oss\Result;

/**
 * Class ExistResult checks if bucket or object exists, according to the http status in response headers.
 *
 * @package SyObjectStorage\Oss\Result
 */
class ExistResult extends Result
{
    /**
     * @return bool
     */
    protected function parseDataFromResponse()
    {
        return 200 === (int)($this->rawResponse->status);
    }

    /**
     * Check if the response status is OK according to the http status code.
     * [200-299]: OK; [404]: Not found. It means the object or bucket is not found--it's a valid response too.
     *
     * @return bool
     */
    protected function isResponseOk()
    {
        $status = $this->rawResponse->status;
        if (2 == (int)((int)$status / 100) || 404 === (int)((int)$status)) {
            return true;
        }

        return false;
    }
}
