<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getModuleName()
 * @method $this withModuleName($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getAliasName()
 * @method $this withAliasName($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getDesc()
 * @method $this withDesc($value)
 */
class CreateOTAModule extends Rpc
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
