<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getBizUid()
 * @method $this withBizUid($value)
 * @method string getUseAnonymousTbAccount()
 * @method $this withUseAnonymousTbAccount($value)
 * @method string getBuyInfo()
 * @method string getThirdPartyUserId()
 * @method $this withThirdPartyUserId($value)
 * @method string getBizId()
 * @method $this withBizId($value)
 */
class CreatePayUrl extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBuyInfo($value)
    {
        $this->data['BuyInfo'] = $value;
        $this->options['form_params']['BuyInfo'] = $value;

        return $this;
    }
}
