<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getDriverProtocol()
 * @method $this withDriverProtocol($value)
 * @method string getDriverName()
 * @method $this withDriverName($value)
 * @method string getIsBuiltIn()
 * @method $this withIsBuiltIn($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getRuntime()
 * @method $this withRuntime($value)
 * @method string getApiProduct()
 * @method string getCpuArch()
 * @method $this withCpuArch($value)
 * @method string getApiRevision()
 */
class CreateEdgeDriver extends Rpc
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
