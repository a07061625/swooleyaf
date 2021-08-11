<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getFlowInstanceId()
 * @method string getUserPk()
 * @method string getOrgId()
 * @method $this withOrgId($value)
 * @method string getPipelineId()
 * @method $this withPipelineId($value)
 */
class GetPipelineInstanceGroupStatus extends Rpc
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
}
