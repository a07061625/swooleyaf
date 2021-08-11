<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getConfigCheckRule()
 * @method $this withConfigCheckRule($value)
 * @method string getArgument()
 * @method $this withArgument($value)
 * @method string getEdgeVersion()
 * @method $this withEdgeVersion($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getDriverId()
 * @method $this withDriverId($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getContainerConfig()
 * @method $this withContainerConfig($value)
 * @method string getDriverVersion()
 * @method $this withDriverVersion($value)
 * @method string getDriverConfig()
 * @method $this withDriverConfig($value)
 * @method string getSourceConfig()
 * @method $this withSourceConfig($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class CreateEdgeDriverVersion extends Rpc
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
