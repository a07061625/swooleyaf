<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getOutProtocol()
 * @method string getStreamType()
 * @method string getCorpId()
 * @method string getGbId()
 * @method string getDeviceId()
 */
class GetDeviceLiveUrl extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOutProtocol($value)
    {
        $this->data['OutProtocol'] = $value;
        $this->options['form_params']['OutProtocol'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStreamType($value)
    {
        $this->data['StreamType'] = $value;
        $this->options['form_params']['StreamType'] = $value;

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
    public function withGbId($value)
    {
        $this->data['GbId'] = $value;
        $this->options['form_params']['GbId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceId($value)
    {
        $this->data['DeviceId'] = $value;
        $this->options['form_params']['DeviceId'] = $value;

        return $this;
    }
}
