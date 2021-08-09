<?php

namespace SyObjectStorage\Oss\Result;

/**
 * Class CallbackResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class CallbackResult extends PutSetDeleteResult
{
    protected function isResponseOk()
    {
        $status = $this->rawResponse->status;
        if (2 == (int)((int)$status / 100) && 203 !== (int)((int)$status)) {
            return true;
        }

        return false;
    }
}
