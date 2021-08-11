<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getRequireCropImage()
 * @method string getCorpId()
 * @method string getRecognizeType()
 * @method string getVendor()
 * @method string getImageUrl()
 * @method string getImageContent()
 */
class RecognizeImage extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRequireCropImage($value)
    {
        $this->data['RequireCropImage'] = $value;
        $this->options['form_params']['RequireCropImage'] = $value;

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
    public function withRecognizeType($value)
    {
        $this->data['RecognizeType'] = $value;
        $this->options['form_params']['RecognizeType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVendor($value)
    {
        $this->data['Vendor'] = $value;
        $this->options['form_params']['Vendor'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageUrl($value)
    {
        $this->data['ImageUrl'] = $value;
        $this->options['form_params']['ImageUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageContent($value)
    {
        $this->data['ImageContent'] = $value;
        $this->options['form_params']['ImageContent'] = $value;

        return $this;
    }
}
