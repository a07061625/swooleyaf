<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getSignMethod()
 * @method $this withSignMethod($value)
 * @method string getNeedToVerify()
 * @method $this withNeedToVerify($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getFirmwareUrl()
 * @method $this withFirmwareUrl($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getFirmwareDesc()
 * @method $this withFirmwareDesc($value)
 * @method string getModuleName()
 * @method $this withModuleName($value)
 * @method string getFirmwareSign()
 * @method $this withFirmwareSign($value)
 * @method string getFirmwareSize()
 * @method $this withFirmwareSize($value)
 * @method string getFirmwareName()
 * @method $this withFirmwareName($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getSrcVersion()
 * @method $this withSrcVersion($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getDestVersion()
 * @method $this withDestVersion($value)
 */
class CreateOTAFirmware extends Rpc
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
