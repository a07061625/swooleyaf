<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getDivisionCode()
 * @method $this withDivisionCode($value)
 * @method string getIp()
 * @method $this withIp($value)
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method array getItemList()
 */
class QueryItemInventory extends Rpc
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
            foreach ($depth1Value['SkuIdList'] as $i => $iValue) {
                $this->options['query']['ItemList.' . ($depth1 + 1) . '.SkuIdList.' . ($i + 1)] = $iValue;
            }
            if (isset($depth1Value['LmItemId'])) {
                $this->options['query']['ItemList.' . ($depth1 + 1) . '.LmItemId'] = $depth1Value['LmItemId'];
            }
        }

        return $this;
    }
}
