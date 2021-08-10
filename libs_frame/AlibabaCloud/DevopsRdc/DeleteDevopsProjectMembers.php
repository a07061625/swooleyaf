<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getUserIds()
 * @method string getProjectId()
 * @method string getOrgId()
 */
class DeleteDevopsProjectMembers extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserIds($value)
    {
        $this->data['UserIds'] = $value;
        $this->options['form_params']['UserIds'] = $value;

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
    public function withOrgId($value)
    {
        $this->data['OrgId'] = $value;
        $this->options['form_params']['OrgId'] = $value;

        return $this;
    }
}
