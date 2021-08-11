<?php

namespace AlibabaCloud\Videoenhan;

/**
 * @method string getUserId()
 * @method string getTemplateId()
 */
class DeleteFaceVideoTemplate extends Rpc
{
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
    public function withTemplateId($value)
    {
        $this->data['TemplateId'] = $value;
        $this->options['form_params']['TemplateId'] = $value;

        return $this;
    }
}
