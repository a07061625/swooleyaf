<?php

namespace AlibabaCloud\Imageenhan;

/**
 * @method string getUrl()
 * @method string getOperation()
 */
class GenerateDynamicImage extends Rpc
{
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOperation($value)
    {
        $this->data['Operation'] = $value;
        $this->options['form_params']['Operation'] = $value;

        return $this;
    }
}
