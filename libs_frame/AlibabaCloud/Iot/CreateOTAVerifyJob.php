<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getTimeoutInMinutes()
 * @method $this withTimeoutInMinutes($value)
 * @method string getNeedConfirm()
 * @method $this withNeedConfirm($value)
 * @method string getNeedPush()
 * @method $this withNeedPush($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getFirmwareId()
 * @method $this withFirmwareId($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method array getTargetDeviceName()
 */
class CreateOTAVerifyJob extends Rpc
{
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
    public function withTargetDeviceName(array $targetDeviceName)
    {
        $this->data['TargetDeviceName'] = $targetDeviceName;
        foreach ($targetDeviceName as $i => $iValue) {
            $this->options['query']['TargetDeviceName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
