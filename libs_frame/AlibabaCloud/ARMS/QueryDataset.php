<?php

namespace AlibabaCloud\ARMS;

/**
 * @method string getDateStr()
 * @method $this withDateStr($value)
 * @method string getMinTime()
 * @method $this withMinTime($value)
 * @method string getProxyUserId()
 * @method $this withProxyUserId($value)
 * @method string getReduceTail()
 * @method $this withReduceTail($value)
 * @method string getMaxTime()
 * @method $this withMaxTime($value)
 * @method array getOptionalDims()
 * @method array getMeasures()
 * @method string getIntervalInSec()
 * @method $this withIntervalInSec($value)
 * @method string getIsDrillDown()
 * @method $this withIsDrillDown($value)
 * @method string getHungryMode()
 * @method $this withHungryMode($value)
 * @method string getOrderByKey()
 * @method $this withOrderByKey($value)
 * @method string getLimit()
 * @method $this withLimit($value)
 * @method string getDatasetId()
 * @method $this withDatasetId($value)
 * @method array getRequiredDims()
 * @method array getDimensions()
 */
class QueryDataset extends Rpc
{
    /**
     * @return $this
     */
    public function withOptionalDims(array $optionalDims)
    {
        $this->data['OptionalDims'] = $optionalDims;
        foreach ($optionalDims as $depth1 => $depth1Value) {
            if (isset($depth1Value['Type'])) {
                $this->options['query']['OptionalDims.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['OptionalDims.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['OptionalDims.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }

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
    public function withRequiredDims(array $requiredDims)
    {
        $this->data['RequiredDims'] = $requiredDims;
        foreach ($requiredDims as $depth1 => $depth1Value) {
            if (isset($depth1Value['Type'])) {
                $this->options['query']['RequiredDims.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['RequiredDims.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['RequiredDims.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
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
            if (isset($depth1Value['Type'])) {
                $this->options['query']['Dimensions.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Dimensions.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Dimensions.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }
}
