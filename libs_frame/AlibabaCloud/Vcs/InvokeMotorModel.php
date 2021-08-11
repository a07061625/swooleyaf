<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getPicPath()
 * @method string getCorpId()
 * @method string getPicUrl()
 * @method string getPicId()
 */
class InvokeMotorModel extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPicPath($value)
    {
        $this->data['PicPath'] = $value;
        $this->options['form_params']['PicPath'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPicUrl($value)
    {
        $this->data['PicUrl'] = $value;
        $this->options['form_params']['PicUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPicId($value)
    {
        $this->data['PicId'] = $value;
        $this->options['form_params']['PicId'] = $value;

        return $this;
    }
}
