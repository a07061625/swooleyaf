<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getDeviceIds()
 * @method string getCorpId()
 * @method string getAppName()
 * @method string getNameSpace()
 */
class UnbindDevice extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceIds($value)
    {
        $this->data['DeviceIds'] = $value;
        $this->options['form_params']['DeviceIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppName($value)
    {
        $this->data['AppName'] = $value;
        $this->options['form_params']['AppName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNameSpace($value)
    {
        $this->data['NameSpace'] = $value;
        $this->options['form_params']['NameSpace'] = $value;

        return $this;
    }
}
