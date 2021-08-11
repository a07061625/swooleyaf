<?php

namespace AlibabaCloud\BssOpenApi;

/**
 * @method array getResourceInstanceList()
 * @method string getFromUnitId()
 * @method $this withFromUnitId($value)
 * @method string getToUnitId()
 * @method $this withToUnitId($value)
 * @method string getFromUnitUserId()
 * @method $this withFromUnitUserId($value)
 * @method string getToUnitUserId()
 * @method $this withToUnitUserId($value)
 */
class AllocateCostUnitResource extends Rpc
{
    /**
     * @return $this
     */
    public function withResourceInstanceList(array $resourceInstanceList)
    {
        $this->data['ResourceInstanceList'] = $resourceInstanceList;
        foreach ($resourceInstanceList as $depth1 => $depth1Value) {
            if (isset($depth1Value['ResourceId'])) {
                $this->options['query']['ResourceInstanceList.' . ($depth1 + 1) . '.ResourceId'] = $depth1Value['ResourceId'];
            }
            if (isset($depth1Value['CommodityCode'])) {
                $this->options['query']['ResourceInstanceList.' . ($depth1 + 1) . '.CommodityCode'] = $depth1Value['CommodityCode'];
            }
            if (isset($depth1Value['ApportionCode'])) {
                $this->options['query']['ResourceInstanceList.' . ($depth1 + 1) . '.ApportionCode'] = $depth1Value['ApportionCode'];
            }
            if (isset($depth1Value['ResourceUserId'])) {
                $this->options['query']['ResourceInstanceList.' . ($depth1 + 1) . '.ResourceUserId'] = $depth1Value['ResourceUserId'];
            }
        }

        return $this;
    }
}
