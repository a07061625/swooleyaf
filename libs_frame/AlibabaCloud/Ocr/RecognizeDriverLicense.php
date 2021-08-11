<?php

namespace AlibabaCloud\Ocr;

/**
 * @method string getImageType()
 * @method string getSide()
 * @method string getImageURL()
 */
class RecognizeDriverLicense extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageType($value)
    {
        $this->data['ImageType'] = $value;
        $this->options['form_params']['ImageType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSide($value)
    {
        $this->data['Side'] = $value;
        $this->options['form_params']['Side'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageURL($value)
    {
        $this->data['ImageURL'] = $value;
        $this->options['form_params']['ImageURL'] = $value;

        return $this;
    }
}
