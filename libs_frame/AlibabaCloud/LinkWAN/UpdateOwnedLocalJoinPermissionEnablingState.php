<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getJoinPermissionId()
 * @method string getEnabled()
 */
class UpdateOwnedLocalJoinPermissionEnablingState extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJoinPermissionId($value)
    {
        $this->data['JoinPermissionId'] = $value;
        $this->options['form_params']['JoinPermissionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnabled($value)
    {
        $this->data['Enabled'] = $value;
        $this->options['form_params']['Enabled'] = $value;

        return $this;
    }
}
