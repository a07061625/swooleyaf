<?php
namespace AliOss\Result;

/**
 * Class CallbackResult
 * @package AliOss\Result
 */
class CallbackResult extends PutSetDeleteResult
{
    protected function isResponseOk()
    {
        $status = $this->rawResponse->status;
        if ((int)(intval($status) / 100) == 2 && (int)(intval($status)) !== 203) {
            return true;
        }

        return false;
    }
}
