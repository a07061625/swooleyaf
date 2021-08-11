<?php

namespace AlibabaCloud\Imageenhan;

/**
 * @method string getMode()
 * @method string getImageURL()
 * @method string getOutputFormat()
 */
class EnhanceImageColor extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMode($value)
    {
        $this->data['Mode'] = $value;
        $this->options['form_params']['Mode'] = $value;

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
}
