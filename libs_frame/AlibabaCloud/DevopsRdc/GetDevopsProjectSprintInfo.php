<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getSprintId()
 * @method string getOrgId()
 */
class GetDevopsProjectSprintInfo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSprintId($value)
    {
        $this->data['SprintId'] = $value;
        $this->options['form_params']['SprintId'] = $value;

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
