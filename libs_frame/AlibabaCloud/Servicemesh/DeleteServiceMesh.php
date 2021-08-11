<?php

namespace AlibabaCloud\Servicemesh;

/**
 * @method string getServiceMeshId()
 * @method string getForce()
 */
class DeleteServiceMesh extends Rpc
{
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withForce($value)
    {
        $this->data['Force'] = $value;
        $this->options['form_params']['Force'] = $value;

        return $this;
    }
}
