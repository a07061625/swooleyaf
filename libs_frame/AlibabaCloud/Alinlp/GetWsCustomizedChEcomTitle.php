<?php

namespace AlibabaCloud\Alinlp;

/**
 * @method string getServiceCode()
 * @method string getTokenizerId()
 * @method string getText()
 * @method string getOutType()
 */
class GetWsCustomizedChEcomTitle extends Rpc
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
    public function withTokenizerId($value)
    {
        $this->data['TokenizerId'] = $value;
        $this->options['form_params']['TokenizerId'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOutType($value)
    {
        $this->data['OutType'] = $value;
        $this->options['form_params']['OutType'] = $value;

        return $this;
    }
}
