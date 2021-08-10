<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getThirdPartyUserId()
 * @method $this withThirdPartyUserId($value)
 * @method string getBizUid()
 * @method $this withBizUid($value)
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method string getUseAnonymousTbAccount()
 * @method $this withUseAnonymousTbAccount($value)
 * @method string getUrl()
 */
class GetSwitchUrl extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUrl($value)
    {
        $this->data['Url'] = $value;
        $this->options['form_params']['Url'] = $value;

        return $this;
    }
}
