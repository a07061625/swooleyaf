<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getRealTenantId()
 * @method $this withRealTenantId($value)
 * @method string getRealTripartiteKey()
 * @method $this withRealTripartiteKey($value)
 * @method string getLoraNodeType()
 * @method $this withLoraNodeType($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getNickname()
 * @method $this withNickname($value)
 * @method string getPinCode()
 * @method $this withPinCode($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getDevEui()
 * @method $this withDevEui($value)
 * @method string getJoinEui()
 * @method $this withJoinEui($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getDeviceName()
 * @method $this withDeviceName($value)
 * @method string getAppKey()
 * @method $this withAppKey($value)
 */
class RegisterDevice extends Rpc
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
}
