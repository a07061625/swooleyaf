<?php

namespace AlibabaCloud\Bss;

/**
 * @method string getParamStr()
 */
class VnoPayCallBackNotify extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParamStr($value)
    {
        $this->data['ParamStr'] = $value;
        $this->options['query']['paramStr'] = $value;

        return $this;
    }
}
