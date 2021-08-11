<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getPictureUrl()
 * @method string getPictureContent()
 * @method string getPictureId()
 */
class GetFaceModelResult extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPictureUrl($value)
    {
        $this->data['PictureUrl'] = $value;
        $this->options['form_params']['PictureUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPictureContent($value)
    {
        $this->data['PictureContent'] = $value;
        $this->options['form_params']['PictureContent'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPictureId($value)
    {
        $this->data['PictureId'] = $value;
        $this->options['form_params']['PictureId'] = $value;

        return $this;
    }
}
