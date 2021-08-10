<?php

namespace AlibabaCloud\Cloudesl;

/**
 * @method string getClientType()
 * @method string getExtraParams()
 */
class DescribeClientPackage extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientType($value)
    {
        $this->data['ClientType'] = $value;
        $this->options['form_params']['ClientType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtraParams($value)
    {
        $this->data['ExtraParams'] = $value;
        $this->options['form_params']['ExtraParams'] = $value;

        return $this;
    }
}
