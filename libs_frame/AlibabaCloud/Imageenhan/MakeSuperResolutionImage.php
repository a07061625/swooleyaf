<?php

namespace AlibabaCloud\Imageenhan;

/**
 * @method string getUpscaleFactor()
 * @method string getMode()
 * @method string getUrl()
 */
class MakeSuperResolutionImage extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUpscaleFactor($value)
    {
        $this->data['UpscaleFactor'] = $value;
        $this->options['form_params']['UpscaleFactor'] = $value;

        return $this;
    }

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
    public function withUrl($value)
    {
        $this->data['Url'] = $value;
        $this->options['form_params']['Url'] = $value;

        return $this;
    }
}
