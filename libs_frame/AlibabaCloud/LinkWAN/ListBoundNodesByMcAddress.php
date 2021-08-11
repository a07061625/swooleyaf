<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getOffset()
 * @method string getLimit()
 * @method string getMcAddress()
 */
class ListBoundNodesByMcAddress extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOffset($value)
    {
        $this->data['Offset'] = $value;
        $this->options['form_params']['Offset'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMcAddress($value)
    {
        $this->data['McAddress'] = $value;
        $this->options['form_params']['McAddress'] = $value;

        return $this;
    }
}
