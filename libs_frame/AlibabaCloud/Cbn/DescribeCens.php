<?php

namespace AlibabaCloud\Cbn;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getTag()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getFilter()
 */
class DescribeCens extends Rpc
{
    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withFilter(array $filter)
    {
        $this->data['Filter'] = $filter;
        foreach ($filter as $depth1 => $depth1Value) {
            foreach ($depth1Value['Value'] as $i => $iValue) {
                $this->options['query']['Filter.' . ($depth1 + 1) . '.Value.' . ($i + 1)] = $iValue;
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Filter.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }
}
