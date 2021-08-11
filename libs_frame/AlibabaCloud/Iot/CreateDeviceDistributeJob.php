<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getCaptcha()
 * @method string getSourceInstanceId()
 * @method string getTargetAliyunId()
 * @method array getTargetInstanceConfig()
 * @method string getProductKey()
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method array getDeviceName()
 * @method string getTargetUid()
 * @method string getStrategy()
 */
class CreateDeviceDistributeJob extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCaptcha($value)
    {
        $this->data['Captcha'] = $value;
        $this->options['form_params']['Captcha'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceInstanceId($value)
    {
        $this->data['SourceInstanceId'] = $value;
        $this->options['form_params']['SourceInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetAliyunId($value)
    {
        $this->data['TargetAliyunId'] = $value;
        $this->options['form_params']['TargetAliyunId'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withTargetInstanceConfig(array $targetInstanceConfig)
    {
        $this->data['TargetInstanceConfig'] = $targetInstanceConfig;
        foreach ($targetInstanceConfig as $depth1 => $depth1Value) {
            if (isset($depth1Value['TargetInstanceId'])) {
                $this->options['form_params']['TargetInstanceConfig.' . ($depth1 + 1) . '.TargetInstanceId'] = $depth1Value['TargetInstanceId'];
            }
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
     * @return $this
     */
    public function withDeviceName(array $deviceName)
    {
        $this->data['DeviceName'] = $deviceName;
        foreach ($deviceName as $i => $iValue) {
            $this->options['form_params']['DeviceName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetUid($value)
    {
        $this->data['TargetUid'] = $value;
        $this->options['form_params']['TargetUid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStrategy($value)
    {
        $this->data['Strategy'] = $value;
        $this->options['form_params']['Strategy'] = $value;

        return $this;
    }
}
