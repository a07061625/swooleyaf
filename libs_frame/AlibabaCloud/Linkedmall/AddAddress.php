<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getAddressInfo()
 * @method string getThirdPartyUserId()
 * @method $this withThirdPartyUserId($value)
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method string getUseAnonymousTbAccount()
 * @method $this withUseAnonymousTbAccount($value)
 */
class AddAddress extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAddressInfo($value)
    {
        $this->data['AddressInfo'] = $value;
        $this->options['form_params']['AddressInfo'] = $value;

        return $this;
    }
}
