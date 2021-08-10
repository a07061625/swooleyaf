<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getRoleName()
 * @method string getUserPk()
 * @method string getUserId()
 * @method string getOrgId()
 * @method $this withOrgId($value)
 * @method string getPipelineId()
 * @method $this withPipelineId($value)
 */
class UpdatePipelineMember extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRoleName($value)
    {
        $this->data['RoleName'] = $value;
        $this->options['form_params']['RoleName'] = $value;

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
    public function withUserId($value)
    {
        $this->data['UserId'] = $value;
        $this->options['form_params']['UserId'] = $value;

        return $this;
    }
}
