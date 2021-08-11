<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getDeploymentId()
 * @method string getProjectId()
 * @method string getProjectIdentifier()
 */
class GetDeployment extends Rpc
{
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectIdentifier($value)
    {
        $this->data['ProjectIdentifier'] = $value;
        $this->options['form_params']['ProjectIdentifier'] = $value;

        return $this;
    }
}
