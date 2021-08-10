<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getTaskFlowId()
 * @method string getOrgId()
 */
class ListDevopsProjectTaskFlowStatus extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskFlowId($value)
    {
        $this->data['TaskFlowId'] = $value;
        $this->options['form_params']['TaskFlowId'] = $value;

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
}
