<?php

namespace AlibabaCloud\Imageprocess;

/**
 * @method string getFromLanguage()
 * @method string getToLanguage()
 * @method string getText()
 */
class TranslateMed extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFromLanguage($value)
    {
        $this->data['FromLanguage'] = $value;
        $this->options['form_params']['FromLanguage'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withToLanguage($value)
    {
        $this->data['ToLanguage'] = $value;
        $this->options['form_params']['ToLanguage'] = $value;

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
