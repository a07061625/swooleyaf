<?php

namespace AlibabaCloud\BssOpenApi;

/**
 * @method string getProductCode()
 * @method $this withProductCode($value)
 * @method string getQuantity()
 * @method $this withQuantity($value)
 * @method string getSubscriptionType()
 * @method $this withSubscriptionType($value)
 * @method array getModuleList()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getProductType()
 * @method $this withProductType($value)
 * @method string getServicePeriodQuantity()
 * @method $this withServicePeriodQuantity($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getServicePeriodUnit()
 * @method $this withServicePeriodUnit($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 * @method string getOrderType()
 * @method $this withOrderType($value)
 */
class GetSubscriptionPrice extends Rpc
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
            if (isset($depth1Value['ModuleStatus'])) {
                $this->options['query']['ModuleList.' . ($depth1 + 1) . '.ModuleStatus'] = $depth1Value['ModuleStatus'];
            }
            if (isset($depth1Value['Tag'])) {
                $this->options['query']['ModuleList.' . ($depth1 + 1) . '.Tag'] = $depth1Value['Tag'];
            }
            if (isset($depth1Value['Config'])) {
                $this->options['query']['ModuleList.' . ($depth1 + 1) . '.Config'] = $depth1Value['Config'];
            }
        }

        return $this;
    }
}
