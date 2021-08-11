<?php

namespace AlibabaCloud\Cas;

/**
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method array getTag()
 * @method string getLang()
 * @method $this withLang($value)
 */
class DescribeCertificateStatusCount extends Rpc
{
    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
        }

        return $this;
    }
}
