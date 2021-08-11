<?php

namespace AlibabaCloud\BssOpenApi;

/**
 * @method string getProductCode()
 * @method $this withProductCode($value)
 * @method string getSubscriptionType()
 * @method $this withSubscriptionType($value)
 * @method array getModuleList()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getProductType()
 * @method $this withProductType($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 */
class GetPayAsYouGoPrice extends Rpc
{
    /**
     * @return $this
     */
    public function withModuleList(array $moduleList)
    {
        $this->data['ModuleList'] = $moduleList;
        foreach ($moduleList as $depth1 => $depth1Value) {
            if (isset($depth1Value['ModuleCode'])) {
                $this->options['query']['ModuleList.' . ($depth1 + 1) . '.ModuleCode'] = $depth1Value['ModuleCode'];
            }
            if (isset($depth1Value['PriceType'])) {
                $this->options['query']['ModuleList.' . ($depth1 + 1) . '.PriceType'] = $depth1Value['PriceType'];
            }
            if (isset($depth1Value['Config'])) {
                $this->options['query']['ModuleList.' . ($depth1 + 1) . '.Config'] = $depth1Value['Config'];
            }
        }

        return $this;
    }
}
