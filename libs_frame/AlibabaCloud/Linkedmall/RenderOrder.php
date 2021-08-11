<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getBizUid()
 * @method $this withBizUid($value)
 * @method string getExtJson()
 * @method $this withExtJson($value)
 * @method string getAccountType()
 * @method $this withAccountType($value)
 * @method string getUseAnonymousTbAccount()
 * @method $this withUseAnonymousTbAccount($value)
 * @method string getLmItemId()
 * @method $this withLmItemId($value)
 * @method array getItemList()
 * @method string getThirdPartyUserId()
 * @method $this withThirdPartyUserId($value)
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method string getDeliveryAddress()
 * @method $this withDeliveryAddress($value)
 */
class RenderOrder extends Rpc
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
            if (isset($depth1Value['Quantity'])) {
                $this->options['query']['ItemList.' . ($depth1 + 1) . '.Quantity'] = $depth1Value['Quantity'];
            }
            if (isset($depth1Value['LmItemId'])) {
                $this->options['query']['ItemList.' . ($depth1 + 1) . '.LmItemId'] = $depth1Value['LmItemId'];
            }
            if (isset($depth1Value['SkuId'])) {
                $this->options['query']['ItemList.' . ($depth1 + 1) . '.SkuId'] = $depth1Value['SkuId'];
            }
        }

        return $this;
    }
}
