<?php

namespace AlibabaCloud\TeambitionAliyun;

/**
 * @method string getOrgId()
 */
class GetOrganizationMembers extends Rpc
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
