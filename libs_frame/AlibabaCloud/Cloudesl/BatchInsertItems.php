<?php

namespace AlibabaCloud\Cloudesl;

/**
 * @method string getExtraParams()
 * @method string getStoreId()
 * @method string getSyncByItemId()
 * @method array getItemInfo()
 */
class BatchInsertItems extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtraParams($value)
    {
        $this->data['ExtraParams'] = $value;
        $this->options['form_params']['ExtraParams'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStoreId($value)
    {
        $this->data['StoreId'] = $value;
        $this->options['form_params']['StoreId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSyncByItemId($value)
    {
        $this->data['SyncByItemId'] = $value;
        $this->options['form_params']['SyncByItemId'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withItemInfo(array $itemInfo)
    {
        $this->data['ItemInfo'] = $itemInfo;
        foreach ($itemInfo as $depth1 => $depth1Value) {
            if (isset($depth1Value['MemberPrice'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.MemberPrice'] = $depth1Value['MemberPrice'];
            }
            if (isset($depth1Value['ActionPrice'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.ActionPrice'] = $depth1Value['ActionPrice'];
            }
            if (isset($depth1Value['BeSourceCode'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.BeSourceCode'] = $depth1Value['BeSourceCode'];
            }
            if (isset($depth1Value['BrandName'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.BrandName'] = $depth1Value['BrandName'];
            }
            if (isset($depth1Value['PromotionStart'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.PromotionStart'] = $depth1Value['PromotionStart'];
            }
            if (isset($depth1Value['PriceUnit'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.PriceUnit'] = $depth1Value['PriceUnit'];
            }
            if (isset($depth1Value['Rank'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.Rank'] = $depth1Value['Rank'];
            }
            if (isset($depth1Value['ItemInfoIndex'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.ItemInfoIndex'] = $depth1Value['ItemInfoIndex'];
            }
            if (isset($depth1Value['ItemBarCode'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.ItemBarCode'] = $depth1Value['ItemBarCode'];
            }
            if (isset($depth1Value['CustomizeFeatureK'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureK'] = $depth1Value['CustomizeFeatureK'];
            }
            if (isset($depth1Value['CustomizeFeatureL'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureL'] = $depth1Value['CustomizeFeatureL'];
            }
            if (isset($depth1Value['CustomizeFeatureM'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureM'] = $depth1Value['CustomizeFeatureM'];
            }
            if (isset($depth1Value['BePromotion'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.BePromotion'] = $depth1Value['BePromotion'];
            }
            if (isset($depth1Value['CustomizeFeatureN'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureN'] = $depth1Value['CustomizeFeatureN'];
            }
            if (isset($depth1Value['CustomizeFeatureO'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureO'] = $depth1Value['CustomizeFeatureO'];
            }
            if (isset($depth1Value['PromotionEnd'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.PromotionEnd'] = $depth1Value['PromotionEnd'];
            }
            if (isset($depth1Value['ItemTitle'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.ItemTitle'] = $depth1Value['ItemTitle'];
            }
            if (isset($depth1Value['CustomizeFeatureC'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureC'] = $depth1Value['CustomizeFeatureC'];
            }
            if (isset($depth1Value['CustomizeFeatureD'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureD'] = $depth1Value['CustomizeFeatureD'];
            }
            if (isset($depth1Value['ItemQrCode'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.ItemQrCode'] = $depth1Value['ItemQrCode'];
            }
            if (isset($depth1Value['CustomizeFeatureE'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureE'] = $depth1Value['CustomizeFeatureE'];
            }
            if (isset($depth1Value['InventoryStatus'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.InventoryStatus'] = $depth1Value['InventoryStatus'];
            }
            if (isset($depth1Value['PromotionReason'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.PromotionReason'] = $depth1Value['PromotionReason'];
            }
            if (isset($depth1Value['CustomizeFeatureF'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureF'] = $depth1Value['CustomizeFeatureF'];
            }
            if (isset($depth1Value['CustomizeFeatureG'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureG'] = $depth1Value['CustomizeFeatureG'];
            }
            if (isset($depth1Value['CustomizeFeatureH'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureH'] = $depth1Value['CustomizeFeatureH'];
            }
            if (isset($depth1Value['CustomizeFeatureI'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureI'] = $depth1Value['CustomizeFeatureI'];
            }
            if (isset($depth1Value['CustomizeFeatureJ'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureJ'] = $depth1Value['CustomizeFeatureJ'];
            }
            if (isset($depth1Value['CustomizeFeatureA'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureA'] = $depth1Value['CustomizeFeatureA'];
            }
            if (isset($depth1Value['CustomizeFeatureB'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CustomizeFeatureB'] = $depth1Value['CustomizeFeatureB'];
            }
            if (isset($depth1Value['SuggestPrice'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.SuggestPrice'] = $depth1Value['SuggestPrice'];
            }
            if (isset($depth1Value['ForestFirstId'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.ForestFirstId'] = $depth1Value['ForestFirstId'];
            }
            if (isset($depth1Value['ProductionPlace'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.ProductionPlace'] = $depth1Value['ProductionPlace'];
            }
            if (isset($depth1Value['Manufacturer'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.Manufacturer'] = $depth1Value['Manufacturer'];
            }
            if (isset($depth1Value['SourceCode'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.SourceCode'] = $depth1Value['SourceCode'];
            }
            if (isset($depth1Value['ItemId'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.ItemId'] = $depth1Value['ItemId'];
            }
            if (isset($depth1Value['BeMember'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.BeMember'] = $depth1Value['BeMember'];
            }
            if (isset($depth1Value['TemplateSceneId'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.TemplateSceneId'] = $depth1Value['TemplateSceneId'];
            }
            if (isset($depth1Value['SalesPrice'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.SalesPrice'] = $depth1Value['SalesPrice'];
            }
            if (isset($depth1Value['OriginalPrice'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.OriginalPrice'] = $depth1Value['OriginalPrice'];
            }
            if (isset($depth1Value['ItemShortTitle'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.ItemShortTitle'] = $depth1Value['ItemShortTitle'];
            }
            if (isset($depth1Value['ForestSecondId'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.ForestSecondId'] = $depth1Value['ForestSecondId'];
            }
            if (isset($depth1Value['ItemPicUrl'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.ItemPicUrl'] = $depth1Value['ItemPicUrl'];
            }
            if (isset($depth1Value['SupplierName'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.SupplierName'] = $depth1Value['SupplierName'];
            }
            if (isset($depth1Value['Material'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.Material'] = $depth1Value['Material'];
            }
            if (isset($depth1Value['ModelNumber'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.ModelNumber'] = $depth1Value['ModelNumber'];
            }
            if (isset($depth1Value['SaleSpec'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.SaleSpec'] = $depth1Value['SaleSpec'];
            }
            if (isset($depth1Value['CategoryName'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.CategoryName'] = $depth1Value['CategoryName'];
            }
            if (isset($depth1Value['TaxFee'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.TaxFee'] = $depth1Value['TaxFee'];
            }
            if (isset($depth1Value['EnergyEfficiency'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.EnergyEfficiency'] = $depth1Value['EnergyEfficiency'];
            }
            if (isset($depth1Value['PromotionText'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.PromotionText'] = $depth1Value['PromotionText'];
            }
            if (isset($depth1Value['SkuId'])) {
                $this->options['form_params']['ItemInfo.' . ($depth1 + 1) . '.SkuId'] = $depth1Value['SkuId'];
            }
        }

        return $this;
    }
}
