<?php

namespace AlibabaCloud\Cas;

/**
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getDocContent()
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getDocTitle()
 * @method $this withDocTitle($value)
 */
class CreateSignatureDocument extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDocContent($value)
    {
        $this->data['DocContent'] = $value;
        $this->options['form_params']['DocContent'] = $value;

        return $this;
    }
}
