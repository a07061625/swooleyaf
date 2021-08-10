<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getAlipayAuthCode()
 * @method string getBizid()
 * @method string getHash()
 */
class DescribeTransactionFor2CBrowser extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlipayAuthCode($value)
    {
        $this->data['AlipayAuthCode'] = $value;
        $this->options['form_params']['AlipayAuthCode'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHash($value)
    {
        $this->data['Hash'] = $value;
        $this->options['form_params']['Hash'] = $value;

        return $this;
    }
}
