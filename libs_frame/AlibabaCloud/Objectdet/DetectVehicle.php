<?php

namespace AlibabaCloud\Objectdet;

/**
 * @method string getImageType()
 * @method string getImageURL()
 */
class DetectVehicle extends Rpc
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
    public function withImageURL($value)
    {
        $this->data['ImageURL'] = $value;
        $this->options['form_params']['ImageURL'] = $value;

        return $this;
    }
}
