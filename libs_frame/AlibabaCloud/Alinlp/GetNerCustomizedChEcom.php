<?php

namespace AlibabaCloud\Alinlp;

/**
 * @method string getLexerId()
 * @method string getServiceCode()
 * @method string getText()
 */
class GetNerCustomizedChEcom extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLexerId($value)
    {
        $this->data['LexerId'] = $value;
        $this->options['form_params']['LexerId'] = $value;

        return $this;
    }

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
