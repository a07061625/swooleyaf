<?php

namespace AlibabaCloud\LinkFace;

/**
 * @method string getImage()
 * @method string getGroupId()
 * @method string getUserId()
 * @method string getUserInfo()
 */
class RegisterFace extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImage($value)
    {
        $this->data['Image'] = $value;
        $this->options['form_params']['Image'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroupId($value)
    {
        $this->data['GroupId'] = $value;
        $this->options['form_params']['GroupId'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserInfo($value)
    {
        $this->data['UserInfo'] = $value;
        $this->options['form_params']['UserInfo'] = $value;

        return $this;
    }
}
