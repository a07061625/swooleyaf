<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getFlowInstanceId()
 * @method string getUserPk()
 * @method string getOrgId()
 * @method string getPipelineId()
 */
class CancelPipeline extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFlowInstanceId($value)
    {
        $this->data['FlowInstanceId'] = $value;
        $this->options['form_params']['FlowInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserPk($value)
    {
        $this->data['UserPk'] = $value;
        $this->options['form_params']['UserPk'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrgId($value)
    {
        $this->data['OrgId'] = $value;
        $this->options['form_params']['OrgId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPipelineId($value)
    {
        $this->data['PipelineId'] = $value;
        $this->options['form_params']['PipelineId'] = $value;

        return $this;
    }
}
