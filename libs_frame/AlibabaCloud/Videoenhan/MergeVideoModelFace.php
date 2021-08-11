<?php

namespace AlibabaCloud\Videoenhan;

/**
 * @method string getFaceImageURL()
 * @method string getUserId()
 * @method string getTemplateId()
 * @method string getAsync()
 */
class MergeVideoModelFace extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFaceImageURL($value)
    {
        $this->data['FaceImageURL'] = $value;
        $this->options['form_params']['FaceImageURL'] = $value;

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
    public function withTemplateId($value)
    {
        $this->data['TemplateId'] = $value;
        $this->options['form_params']['TemplateId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAsync($value)
    {
        $this->data['Async'] = $value;
        $this->options['form_params']['Async'] = $value;

        return $this;
    }
}
