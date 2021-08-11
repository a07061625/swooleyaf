<?php

namespace AlibabaCloud\Goodstech;

/**
 * @method string getXLength()
 * @method string getZLength()
 * @method string getImageURL()
 * @method string getYLength()
 */
class RecognizeFurnitureSpu extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withXLength($value)
    {
        $this->data['XLength'] = $value;
        $this->options['form_params']['XLength'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withZLength($value)
    {
        $this->data['ZLength'] = $value;
        $this->options['form_params']['ZLength'] = $value;

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
    public function withYLength($value)
    {
        $this->data['YLength'] = $value;
        $this->options['form_params']['YLength'] = $value;

        return $this;
    }
}
