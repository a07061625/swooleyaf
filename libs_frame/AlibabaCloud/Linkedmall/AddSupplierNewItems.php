<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method array getItemList()
 */
class AddSupplierNewItems extends Rpc
{
    /**
     * @return $this
     */
    public function withItemList(array $itemList)
    {
        $this->data['ItemList'] = $itemList;
        foreach ($itemList as $depth1 => $depth1Value) {
            if (isset($depth1Value['ItemId'])) {
                $this->options['query']['ItemList.' . ($depth1 + 1) . '.ItemId'] = $depth1Value['ItemId'];
            }
            if (isset($depth1Value['LmItemId'])) {
                $this->options['query']['ItemList.' . ($depth1 + 1) . '.LmItemId'] = $depth1Value['LmItemId'];
            }
            foreach ($depth1Value['SkuList'] as $i => $iValue) {
                $this->options['query']['ItemList.' . ($depth1 + 1) . '.SkuList.' . ($i + 1)] = $iValue;
            }
        }

        return $this;
    }
}
