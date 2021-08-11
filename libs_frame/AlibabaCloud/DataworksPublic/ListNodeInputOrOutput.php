<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getProjectEnv()
 * @method string getNodeId()
 * @method string getIoType()
 */
class ListNodeInputOrOutput extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectEnv($value)
    {
        $this->data['ProjectEnv'] = $value;
        $this->options['form_params']['ProjectEnv'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeId($value)
    {
        $this->data['NodeId'] = $value;
        $this->options['form_params']['NodeId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIoType($value)
    {
        $this->data['IoType'] = $value;
        $this->options['form_params']['IoType'] = $value;

        return $this;
    }
}
