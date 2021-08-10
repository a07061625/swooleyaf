<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getUserFlag()
 * @method $this withUserFlag($value)
 * @method string getAppName()
 * @method $this withAppName($value)
 * @method string getQueryJson()
 * @method string getBizId()
 * @method $this withBizId($value)
 */
class GetUserInfo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withQueryJson($value)
    {
        $this->data['QueryJson'] = $value;
        $this->options['form_params']['QueryJson'] = $value;

        return $this;
    }
}
