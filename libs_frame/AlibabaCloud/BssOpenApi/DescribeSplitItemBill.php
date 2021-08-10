<?php

namespace AlibabaCloud\BssOpenApi;

/**
 * @method string getProductCode()
 * @method $this withProductCode($value)
 * @method string getSubscriptionType()
 * @method $this withSubscriptionType($value)
 * @method string getBillOwnerId()
 * @method $this withBillOwnerId($value)
 * @method string getProductType()
 * @method $this withProductType($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getSplitItemID()
 * @method $this withSplitItemID($value)
 * @method string getBillingCycle()
 * @method $this withBillingCycle($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getTagFilter()
 * @method string getBillingDate()
 * @method $this withBillingDate($value)
 * @method string getInstanceID()
 * @method $this withInstanceID($value)
 * @method string getGranularity()
 * @method $this withGranularity($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class DescribeSplitItemBill extends Rpc
{
    /**
     * @return $this
     */
    public function withTagFilter(array $tagFilter)
    {
        $this->data['TagFilter'] = $tagFilter;
        foreach ($tagFilter as $depth1 => $depth1Value) {
            foreach ($depth1Value['TagValues'] as $i => $iValue) {
                $this->options['query']['TagFilter.' . ($depth1 + 1) . '.TagValues.' . ($i + 1)] = $iValue;
            }
            if (isset($depth1Value['TagKey'])) {
                $this->options['query']['TagFilter.' . ($depth1 + 1) . '.TagKey'] = $depth1Value['TagKey'];
            }
        }

        return $this;
    }
}
