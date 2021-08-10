<?php

namespace AlibabaCloud\Jarvis;

/**
 * @method string getSrcIP()
 * @method $this withSrcIP($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getQueryProduct()
 * @method string getDstIP()
 * @method $this withDstIP($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getSourceCode()
 * @method $this withSourceCode($value)
 */
class DeleteWhiteListDbItemConditional extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withQueryProduct($value)
    {
        $this->data['QueryProduct'] = $value;
        $this->options['query']['queryProduct'] = $value;

        return $this;
    }
}
