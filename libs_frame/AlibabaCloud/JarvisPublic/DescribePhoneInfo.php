<?php

namespace AlibabaCloud\JarvisPublic;

/**
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getPhoneNum()
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getSourceCode()
 */
class DescribePhoneInfo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPhoneNum($value)
    {
        $this->data['PhoneNum'] = $value;
        $this->options['query']['phoneNum'] = $value;

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
