<?php

namespace AlibabaCloud\ImageSearch;

/**
 * @method string getInstanceName()
 * @method string getProductId()
 * @method string getPicName()
 */
class DeleteImage extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/image/delete';

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
}
