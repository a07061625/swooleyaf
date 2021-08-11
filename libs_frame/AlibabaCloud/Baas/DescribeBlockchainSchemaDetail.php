<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getSchemaId()
 * @method string getBizid()
 */
class DescribeBlockchainSchemaDetail extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSchemaId($value)
    {
        $this->data['SchemaId'] = $value;
        $this->options['form_params']['SchemaId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizid($value)
    {
        $this->data['Bizid'] = $value;
        $this->options['form_params']['Bizid'] = $value;

        return $this;
    }
}
