<?php

namespace AlibabaCloud\Oms;

/**
 * @method string getDataType()
 * @method $this withDataType($value)
 * @method string getProductName()
 * @method $this withProductName($value)
 * @method string getSiteBid()
 */
class GetProductDefine extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSiteBid($value)
    {
        $this->data['SiteBid'] = $value;
        $this->options['query']['siteBid'] = $value;

        return $this;
    }
}
