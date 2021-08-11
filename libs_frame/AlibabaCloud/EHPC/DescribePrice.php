<?php

namespace AlibabaCloud\EHPC;

/**
 * @method array getCommodities()
 * @method string getPriceUnit()
 * @method $this withPriceUnit($value)
 * @method string getChargeType()
 * @method $this withChargeType($value)
 * @method string getOrderType()
 * @method $this withOrderType($value)
 */
class DescribePrice extends Rpc
{
    /**
     * @return $this
     */
    public function withCommodities(array $commodities)
    {
        $this->data['Commodities'] = $commodities;
        foreach ($commodities as $depth1 => $depth1Value) {
            if (isset($depth1Value['Amount'])) {
                $this->options['query']['Commodities.' . ($depth1 + 1) . '.Amount'] = $depth1Value['Amount'];
            }
            if (isset($depth1Value['Period'])) {
                $this->options['query']['Commodities.' . ($depth1 + 1) . '.Period'] = $depth1Value['Period'];
            }
            if (isset($depth1Value['NodeType'])) {
                $this->options['query']['Commodities.' . ($depth1 + 1) . '.NodeType'] = $depth1Value['NodeType'];
            }
            if (isset($depth1Value['SystemDiskCategory'])) {
                $this->options['query']['Commodities.' . ($depth1 + 1) . '.SystemDiskCategory'] = $depth1Value['SystemDiskCategory'];
            }
            if (isset($depth1Value['InternetChargeType'])) {
                $this->options['query']['Commodities.' . ($depth1 + 1) . '.InternetChargeType'] = $depth1Value['InternetChargeType'];
            }
            if (isset($depth1Value['SystemDiskPerformanceLevel'])) {
                $this->options['query']['Commodities.' . ($depth1 + 1) . '.SystemDiskPerformanceLevel'] = $depth1Value['SystemDiskPerformanceLevel'];
            }
            if (isset($depth1Value['SystemDiskSize'])) {
                $this->options['query']['Commodities.' . ($depth1 + 1) . '.SystemDiskSize'] = $depth1Value['SystemDiskSize'];
            }
            if (isset($depth1Value['InternetMaxBandWidthOut'])) {
                $this->options['query']['Commodities.' . ($depth1 + 1) . '.InternetMaxBandWidthOut'] = $depth1Value['InternetMaxBandWidthOut'];
            }
            if (isset($depth1Value['InstanceType'])) {
                $this->options['query']['Commodities.' . ($depth1 + 1) . '.InstanceType'] = $depth1Value['InstanceType'];
            }
            if (isset($depth1Value['NetworkType'])) {
                $this->options['query']['Commodities.' . ($depth1 + 1) . '.NetworkType'] = $depth1Value['NetworkType'];
            }
        }

        return $this;
    }
}
