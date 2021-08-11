<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getProjectCode()
 * @method string getIotId()
 * @method string getIotInstanceId()
 * @method string getPushMode()
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method array getSpeechCodeList()
 * @method string getProductKey()
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getDeviceName()
 */
class PushSpeech extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectCode($value)
    {
        $this->data['ProjectCode'] = $value;
        $this->options['form_params']['ProjectCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIotId($value)
    {
        $this->data['IotId'] = $value;
        $this->options['form_params']['IotId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIotInstanceId($value)
    {
        $this->data['IotInstanceId'] = $value;
        $this->options['form_params']['IotInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPushMode($value)
    {
        $this->data['PushMode'] = $value;
        $this->options['form_params']['PushMode'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withSpeechCodeList(array $speechCodeList)
    {
        $this->data['SpeechCodeList'] = $speechCodeList;
        foreach ($speechCodeList as $i => $iValue) {
            $this->options['form_params']['SpeechCodeList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProductKey($value)
    {
        $this->data['ProductKey'] = $value;
        $this->options['form_params']['ProductKey'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceName($value)
    {
        $this->data['DeviceName'] = $value;
        $this->options['form_params']['DeviceName'] = $value;

        return $this;
    }
}
