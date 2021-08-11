<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCorpId()
 * @method string getPicUrl()
 * @method string getPicContent()
 * @method string getPicFormat()
 */
class RecognizeFaceQuality extends Rpc
{
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
    public function withPicContent($value)
    {
        $this->data['PicContent'] = $value;
        $this->options['form_params']['PicContent'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPicFormat($value)
    {
        $this->data['PicFormat'] = $value;
        $this->options['form_params']['PicFormat'] = $value;

        return $this;
    }
}
