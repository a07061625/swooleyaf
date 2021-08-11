<?php

namespace AlibabaCloud\Alimt;

/**
 * @method string getSourceText()
 */
class GetDetectLanguage extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceText($value)
    {
        $this->data['SourceText'] = $value;
        $this->options['form_params']['SourceText'] = $value;

        return $this;
    }
}
