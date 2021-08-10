<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getRealTenantId()
 * @method $this withRealTenantId($value)
 * @method string getRealTripartiteKey()
 * @method $this withRealTripartiteKey($value)
 * @method string getIotId()
 * @method $this withIotId($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getIdentifier()
 * @method $this withIdentifier($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getArgs()
 * @method $this withArgs($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getDeviceName()
 * @method $this withDeviceName($value)
 */
class InvokeThingService extends Rpc
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
