<?php

namespace AlibabaCloud\ARMS;

/**
 * @method string getConsistencyQueryStrategy()
 * @method $this withConsistencyQueryStrategy($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOrderBy()
 * @method $this withOrderBy($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method array getFilters()
 * @method string getConsistencyDataKey()
 * @method $this withConsistencyDataKey($value)
 * @method string getProxyUserId()
 * @method $this withProxyUserId($value)
 * @method array getMeasures()
 * @method string getIntervalInSec()
 * @method $this withIntervalInSec($value)
 * @method string getMetric()
 * @method $this withMetric($value)
 * @method string getLimit()
 * @method $this withLimit($value)
 * @method array getDimensions()
 * @method string getOrder()
 * @method $this withOrder($value)
 */
class QueryMetric extends Rpc
{
    /**
     * @return $this
     */
    public function withFilters(array $filters)
    {
        $this->data['Filters'] = $filters;
        foreach ($filters as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Filters.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Filters.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
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
    public function withDimensions(array $dimensions)
    {
        $this->data['Dimensions'] = $dimensions;
        foreach ($dimensions as $i => $iValue) {
            $this->options['query']['Dimensions.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
