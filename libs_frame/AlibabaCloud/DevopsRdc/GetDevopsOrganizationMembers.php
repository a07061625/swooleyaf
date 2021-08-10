<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getOrgId()
 */
class GetDevopsOrganizationMembers extends Rpc
{
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
