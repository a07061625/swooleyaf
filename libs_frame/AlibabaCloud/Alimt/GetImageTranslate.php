<?php

namespace AlibabaCloud\Alimt;

/**
 * @method string getSourceLanguage()
 * @method string getUrl()
 * @method string getExtra()
 * @method string getTargetLanguage()
 */
class GetImageTranslate extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceLanguage($value)
    {
        $this->data['SourceLanguage'] = $value;
        $this->options['form_params']['SourceLanguage'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtra($value)
    {
        $this->data['Extra'] = $value;
        $this->options['form_params']['Extra'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetLanguage($value)
    {
        $this->data['TargetLanguage'] = $value;
        $this->options['form_params']['TargetLanguage'] = $value;

        return $this;
    }
}
