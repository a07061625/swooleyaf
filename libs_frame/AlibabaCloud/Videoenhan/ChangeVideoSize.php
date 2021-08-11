<?php

namespace AlibabaCloud\Videoenhan;

/**
 * @method string getHeight()
 * @method string getB()
 * @method string getFillType()
 * @method string getG()
 * @method string getCropType()
 * @method string getAsync()
 * @method string getR()
 * @method string getVideoUrl()
 * @method string getWidth()
 * @method string getTightness()
 */
class ChangeVideoSize extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHeight($value)
    {
        $this->data['Height'] = $value;
        $this->options['form_params']['Height'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withB($value)
    {
        $this->data['B'] = $value;
        $this->options['form_params']['B'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFillType($value)
    {
        $this->data['FillType'] = $value;
        $this->options['form_params']['FillType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withG($value)
    {
        $this->data['G'] = $value;
        $this->options['form_params']['G'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCropType($value)
    {
        $this->data['CropType'] = $value;
        $this->options['form_params']['CropType'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withR($value)
    {
        $this->data['R'] = $value;
        $this->options['form_params']['R'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVideoUrl($value)
    {
        $this->data['VideoUrl'] = $value;
        $this->options['form_params']['VideoUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWidth($value)
    {
        $this->data['Width'] = $value;
        $this->options['form_params']['Width'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTightness($value)
    {
        $this->data['Tightness'] = $value;
        $this->options['form_params']['Tightness'] = $value;

        return $this;
    }
}
