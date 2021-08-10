<?php

namespace AlibabaCloud\Alinlp;

/**
 * @method string getServiceCode()
 * @method string getText()
 */
class GetTcChGeneral extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceCode($value)
    {
        $this->data['ServiceCode'] = $value;
        $this->options['form_params']['ServiceCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withText($value)
    {
        $this->data['Text'] = $value;
        $this->options['form_params']['Text'] = $value;

        return $this;
    }
}
