<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getThirdPartyUserId()
 * @method $this withThirdPartyUserId($value)
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method string getUseAnonymousTbAccount()
 * @method $this withUseAnonymousTbAccount($value)
 * @method string getTargetUrl()
 * @method string getFailUrl()
 */
class GetLoginPage extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetUrl($value)
    {
        $this->data['TargetUrl'] = $value;
        $this->options['form_params']['TargetUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFailUrl($value)
    {
        $this->data['FailUrl'] = $value;
        $this->options['form_params']['FailUrl'] = $value;

        return $this;
    }
}
