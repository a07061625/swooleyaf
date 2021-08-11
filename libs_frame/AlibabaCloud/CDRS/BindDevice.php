<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getCorpId()
 * @method array getDevices()
 * @method string getAppName()
 * @method string getNameSpace()
 */
class BindDevice extends Rpc
{
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
     * @return $this
     */
    public function withDevices(array $devices)
    {
        $this->data['Devices'] = $devices;
        foreach ($devices as $depth1 => $depth1Value) {
            if (isset($depth1Value['CorpId'])) {
                $this->options['form_params']['Devices.' . ($depth1 + 1) . '.CorpId'] = $depth1Value['CorpId'];
            }
            if (isset($depth1Value['DeviceId'])) {
                $this->options['form_params']['Devices.' . ($depth1 + 1) . '.DeviceId'] = $depth1Value['DeviceId'];
            }
        }

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
