<?php

namespace AlibabaCloud\Servicemesh;

/**
 * @method string getEnableIstioInjection()
 * @method string getNamespace()
 * @method string getServiceMeshId()
 */
class UpdateIstioInjectionConfig extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnableIstioInjection($value)
    {
        $this->data['EnableIstioInjection'] = $value;
        $this->options['form_params']['EnableIstioInjection'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNamespace($value)
    {
        $this->data['Namespace'] = $value;
        $this->options['form_params']['Namespace'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceMeshId($value)
    {
        $this->data['ServiceMeshId'] = $value;
        $this->options['form_params']['ServiceMeshId'] = $value;

        return $this;
    }
}
