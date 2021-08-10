<?php

namespace AlibabaCloud\MPServerless;

/**
 * @method string getSpaceId()
 * @method string getDeploymentId()
 */
class DeployFunction extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSpaceId($value)
    {
        $this->data['SpaceId'] = $value;
        $this->options['form_params']['SpaceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeploymentId($value)
    {
        $this->data['DeploymentId'] = $value;
        $this->options['form_params']['DeploymentId'] = $value;

        return $this;
    }
}
