<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getBizid()
 */
class DescribeBlockchainInfo extends Rpc
{
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
