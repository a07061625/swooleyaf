<?php

namespace AlibabaCloud\Idrsservice;

/**
 * @method string getPrefix()
 * @method string getLimit()
 */
class ListFiles extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPrefix($value)
    {
        $this->data['Prefix'] = $value;
        $this->options['form_params']['Prefix'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLimit($value)
    {
        $this->data['Limit'] = $value;
        $this->options['form_params']['Limit'] = $value;

        return $this;
    }
}
