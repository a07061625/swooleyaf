<?php

namespace AlibabaCloud\TeambitionAliyun;

/**
 * @method string getProjectIds()
 * @method string getOrgId()
 */
class ListProjectTasks extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectIds($value)
    {
        $this->data['ProjectIds'] = $value;
        $this->options['form_params']['ProjectIds'] = $value;

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
