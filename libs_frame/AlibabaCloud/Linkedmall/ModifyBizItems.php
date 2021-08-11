<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method array getItemList()
 * @method string getSubBizId()
 * @method $this withSubBizId($value)
 */
class ModifyBizItems extends Rpc
{
    /**
     * @return $this
     */
    public function withItemList(array $itemList)
    {
        $this->data['ItemList'] = $itemList;
        foreach ($itemList as $depth1 => $depth1Value) {
            if (isset($depth1Value['ItemId'])) {
                $this->options['form_params']['ItemList.' . ($depth1 + 1) . '.ItemId'] = $depth1Value['ItemId'];
            }
            if (isset($depth1Value['LmItemId'])) {
                $this->options['form_params']['ItemList.' . ($depth1 + 1) . '.LmItemId'] = $depth1Value['LmItemId'];
            }
            foreach ($depth1Value['SkuList'] as $depth2 => $depth2Value) {
                if (isset($depth2Value['StatusAction'])) {
                    $this->options['form_params']['ItemList.' . ($depth1 + 1) . '.SkuList.' . ($depth2 + 1) . '.StatusAction'] = $depth2Value['StatusAction'];
                }
                if (isset($depth2Value['PriceCent'])) {
                    $this->options['form_params']['ItemList.' . ($depth1 + 1) . '.SkuList.' . ($depth2 + 1) . '.PriceCent'] = $depth2Value['PriceCent'];
                }
                if (isset($depth2Value['PointsAmount'])) {
                    $this->options['form_params']['ItemList.' . ($depth1 + 1) . '.SkuList.' . ($depth2 + 1) . '.PointsAmount'] = $depth2Value['PointsAmount'];
                }
                if (isset($depth2Value['Quantity'])) {
                    $this->options['form_params']['ItemList.' . ($depth1 + 1) . '.SkuList.' . ($depth2 + 1) . '.Quantity'] = $depth2Value['Quantity'];
                }
                if (isset($depth2Value['BenefitId'])) {
                    $this->options['form_params']['ItemList.' . ($depth1 + 1) . '.SkuList.' . ($depth2 + 1) . '.BenefitId'] = $depth2Value['BenefitId'];
                }
                if (isset($depth2Value['SkuId'])) {
                    $this->options['form_params']['ItemList.' . ($depth1 + 1) . '.SkuList.' . ($depth2 + 1) . '.SkuId'] = $depth2Value['SkuId'];
                }
                if (isset($depth2Value['Points'])) {
                    $this->options['form_params']['ItemList.' . ($depth1 + 1) . '.SkuList.' . ($depth2 + 1) . '.Points'] = $depth2Value['Points'];
                }
            }
        }

        return $this;
    }
}
