<?php

namespace AlibabaCloud\Jarvis;

/**
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getSrcUid()
 * @method string getSourceCode()
 */
class DescribeDdosDefenseInfo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSrcUid($value)
    {
        $this->data['SrcUid'] = $value;
        $this->options['query']['srcUid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceCode($value)
    {
        $this->data['SourceCode'] = $value;
        $this->options['query']['sourceCode'] = $value;

        return $this;
    }
}
