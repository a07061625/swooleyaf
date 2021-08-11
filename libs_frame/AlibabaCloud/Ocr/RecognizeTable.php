<?php

namespace AlibabaCloud\Ocr;

/**
 * @method string getImageType()
 * @method string getUseFinanceModel()
 * @method string getSkipDetection()
 * @method string getImageURL()
 * @method string getOutputFormat()
 * @method string getAssureDirection()
 * @method string getHasLine()
 */
class RecognizeTable extends Rpc
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
    public function withUseFinanceModel($value)
    {
        $this->data['UseFinanceModel'] = $value;
        $this->options['form_params']['UseFinanceModel'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSkipDetection($value)
    {
        $this->data['SkipDetection'] = $value;
        $this->options['form_params']['SkipDetection'] = $value;

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
    public function withOutputFormat($value)
    {
        $this->data['OutputFormat'] = $value;
        $this->options['form_params']['OutputFormat'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAssureDirection($value)
    {
        $this->data['AssureDirection'] = $value;
        $this->options['form_params']['AssureDirection'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHasLine($value)
    {
        $this->data['HasLine'] = $value;
        $this->options['form_params']['HasLine'] = $value;

        return $this;
    }
}
