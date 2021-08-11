<?php

namespace AlibabaCloud\Imageenhan;

/**
 * @method string getWatermarkImageURL()
 * @method string getQualityFactor()
 * @method string getFunctionType()
 * @method string getLogoURL()
 * @method string getOutputFileType()
 * @method string getOriginImageURL()
 */
class ImageBlindPicWatermark extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWatermarkImageURL($value)
    {
        $this->data['WatermarkImageURL'] = $value;
        $this->options['form_params']['WatermarkImageURL'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withQualityFactor($value)
    {
        $this->data['QualityFactor'] = $value;
        $this->options['form_params']['QualityFactor'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFunctionType($value)
    {
        $this->data['FunctionType'] = $value;
        $this->options['form_params']['FunctionType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLogoURL($value)
    {
        $this->data['LogoURL'] = $value;
        $this->options['form_params']['LogoURL'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOutputFileType($value)
    {
        $this->data['OutputFileType'] = $value;
        $this->options['form_params']['OutputFileType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOriginImageURL($value)
    {
        $this->data['OriginImageURL'] = $value;
        $this->options['form_params']['OriginImageURL'] = $value;

        return $this;
    }
}
