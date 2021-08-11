<?php

namespace AlibabaCloud\Cloudesl;

/**
 * @method string getExtraParams()
 * @method string getDingTalkUserId()
 * @method string getUserId()
 * @method string getDingTalkCompanyId()
 */
class UpdateUser extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtraParams($value)
    {
        $this->data['ExtraParams'] = $value;
        $this->options['form_params']['ExtraParams'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDingTalkUserId($value)
    {
        $this->data['DingTalkUserId'] = $value;
        $this->options['form_params']['DingTalkUserId'] = $value;

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
    public function withDingTalkCompanyId($value)
    {
        $this->data['DingTalkCompanyId'] = $value;
        $this->options['form_params']['DingTalkCompanyId'] = $value;

        return $this;
    }
}
