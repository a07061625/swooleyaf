<?php

namespace AlibabaCloud\Ocr;

/**
 * @method string getImageType()
 * @method string getOutputProbability()
 * @method string getImageURL()
 * @method string getMinHeight()
 */
class RecognizeCharacter extends Rpc
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
    public function withOutputProbability($value)
    {
        $this->data['OutputProbability'] = $value;
        $this->options['form_params']['OutputProbability'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMinHeight($value)
    {
        $this->data['MinHeight'] = $value;
        $this->options['form_params']['MinHeight'] = $value;

        return $this;
    }
}
