<?php

namespace AlibabaCloud\ARMS4FINANCE;

/**
 * @method array getMeasures()
 * @method string getIntervalInSec()
 * @method $this withIntervalInSec($value)
 * @method string getDateStr()
 * @method $this withDateStr($value)
 * @method string getIsDrillDown()
 * @method $this withIsDrillDown($value)
 * @method string getMinTime()
 * @method $this withMinTime($value)
 * @method string getDatasetId()
 * @method $this withDatasetId($value)
 * @method string getMaxTime()
 * @method $this withMaxTime($value)
 * @method array getDimensions()
 */
class ARMSQueryDataSet extends Rpc
{
    /**
     * @return $this
     */
    public function withMeasures(array $measures)
    {
        $this->data['Measures'] = $measures;
        foreach ($measures as $i => $iValue) {
            $this->options['query']['Measures.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDimensions(array $dimensions)
    {
        $this->data['Dimensions'] = $dimensions;
        foreach ($dimensions as $depth1 => $depth1Value) {
            $this->options['query']['Dimensions.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            $this->options['query']['Dimensions.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
        }

        return $this;
    }
}
