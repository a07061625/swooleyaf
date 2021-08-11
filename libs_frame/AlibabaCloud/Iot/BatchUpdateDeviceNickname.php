<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getRealTenantId()
 * @method $this withRealTenantId($value)
 * @method string getRealTripartiteKey()
 * @method $this withRealTripartiteKey($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method array getDeviceNicknameInfo()
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class BatchUpdateDeviceNickname extends Rpc
{
    /**
     * @return $this
     */
    public function withDeviceNicknameInfo(array $deviceNicknameInfo)
    {
        $this->data['DeviceNicknameInfo'] = $deviceNicknameInfo;
        foreach ($deviceNicknameInfo as $depth1 => $depth1Value) {
            if (isset($depth1Value['IotId'])) {
                $this->options['query']['DeviceNicknameInfo.' . ($depth1 + 1) . '.IotId'] = $depth1Value['IotId'];
            }
            if (isset($depth1Value['Nickname'])) {
                $this->options['query']['DeviceNicknameInfo.' . ($depth1 + 1) . '.Nickname'] = $depth1Value['Nickname'];
            }
            if (isset($depth1Value['DeviceName'])) {
                $this->options['query']['DeviceNicknameInfo.' . ($depth1 + 1) . '.DeviceName'] = $depth1Value['DeviceName'];
            }
            if (isset($depth1Value['ProductKey'])) {
                $this->options['query']['DeviceNicknameInfo.' . ($depth1 + 1) . '.ProductKey'] = $depth1Value['ProductKey'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
