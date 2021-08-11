<?php

namespace AlibabaCloud\Reid;

/**
 * @method string getIpcIdList()
 * @method string getStoreId()
 */
class ListDevicesImages extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIpcIdList($value)
    {
        $this->data['IpcIdList'] = $value;
        $this->options['form_params']['IpcIdList'] = $value;

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
}
