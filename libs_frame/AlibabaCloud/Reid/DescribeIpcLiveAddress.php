<?php

namespace AlibabaCloud\Reid;

/**
 * @method string getIpcId()
 * @method string getStoreId()
 * @method string getProtocolType()
 */
class DescribeIpcLiveAddress extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIpcId($value)
    {
        $this->data['IpcId'] = $value;
        $this->options['form_params']['IpcId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStoreId($value)
    {
        $this->data['StoreId'] = $value;
        $this->options['form_params']['StoreId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProtocolType($value)
    {
        $this->data['ProtocolType'] = $value;
        $this->options['form_params']['ProtocolType'] = $value;

        return $this;
    }
}
