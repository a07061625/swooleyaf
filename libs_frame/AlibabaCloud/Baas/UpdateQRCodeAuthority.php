<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getAuthorized()
 * @method string getBizid()
 */
class UpdateQRCodeAuthority extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAuthorized($value)
    {
        $this->data['Authorized'] = $value;
        $this->options['form_params']['Authorized'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizid($value)
    {
        $this->data['Bizid'] = $value;
        $this->options['form_params']['Bizid'] = $value;

        return $this;
    }
}
