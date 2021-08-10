<?php

namespace AlibabaCloud\Cas;

/**
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getShowSize()
 * @method $this withShowSize($value)
 * @method string getBrandId()
 * @method $this withBrandId($value)
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 * @method array getTag()
 * @method string getKeyword()
 * @method $this withKeyword($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class DescribeOrderList extends Rpc
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
