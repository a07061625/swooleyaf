<?php

namespace AlibabaCloud\ImageSearch;

/**
 * @method string getPicContent()
 * @method string getStrAttr()
 * @method string getInstanceName()
 * @method string getIntAttr()
 * @method string getProductId()
 * @method string getPicName()
 * @method string getCustomContent()
 * @method string getRegion()
 * @method string getCategoryId()
 * @method string getCrop()
 */
class AddImage extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/image/add';

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
    public function withStrAttr($value)
    {
        $this->data['StrAttr'] = $value;
        $this->options['form_params']['StrAttr'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceName($value)
    {
        $this->data['InstanceName'] = $value;
        $this->options['form_params']['InstanceName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIntAttr($value)
    {
        $this->data['IntAttr'] = $value;
        $this->options['form_params']['IntAttr'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProductId($value)
    {
        $this->data['ProductId'] = $value;
        $this->options['form_params']['ProductId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPicName($value)
    {
        $this->data['PicName'] = $value;
        $this->options['form_params']['PicName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCustomContent($value)
    {
        $this->data['CustomContent'] = $value;
        $this->options['form_params']['CustomContent'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRegion($value)
    {
        $this->data['Region'] = $value;
        $this->options['form_params']['Region'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCategoryId($value)
    {
        $this->data['CategoryId'] = $value;
        $this->options['form_params']['CategoryId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCrop($value)
    {
        $this->data['Crop'] = $value;
        $this->options['form_params']['Crop'] = $value;

        return $this;
    }
}
