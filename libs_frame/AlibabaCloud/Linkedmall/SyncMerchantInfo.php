<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getSellerNick()
 * @method $this withSellerNick($value)
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method string getItemList()
 * @method string getTaskId()
 * @method $this withTaskId($value)
 * @method string getTimeStamp()
 * @method $this withTimeStamp($value)
 */
class SyncMerchantInfo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withItemList($value)
    {
        $this->data['ItemList'] = $value;
        $this->options['form_params']['ItemList'] = $value;

        return $this;
    }
}
