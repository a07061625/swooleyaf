<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getProjectId()
 * @method string getCommonGroupId()
 * @method string getOrgId()
 */
class DeleteCommonGroup extends Rpc
{
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
    public function withCommonGroupId($value)
    {
        $this->data['CommonGroupId'] = $value;
        $this->options['form_params']['CommonGroupId'] = $value;

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
