<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getJoinPermissionId()
 * @method string getRenterAliyunId()
 */
class SubmitJoinPermissionAuthOrder extends Rpc
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
    public function withRenterAliyunId($value)
    {
        $this->data['RenterAliyunId'] = $value;
        $this->options['form_params']['RenterAliyunId'] = $value;

        return $this;
    }
}
