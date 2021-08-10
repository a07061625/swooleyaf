<?php

namespace AlibabaCloud\NlpAutoml;

/**
 * @method string getProduct()
 * @method string getContactScene()
 * @method string getContactPath()
 */
class RunContactReview extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProduct($value)
    {
        $this->data['Product'] = $value;
        $this->options['form_params']['Product'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContactScene($value)
    {
        $this->data['ContactScene'] = $value;
        $this->options['form_params']['ContactScene'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContactPath($value)
    {
        $this->data['ContactPath'] = $value;
        $this->options['form_params']['ContactPath'] = $value;

        return $this;
    }
}
