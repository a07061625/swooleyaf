<?php

namespace AlibabaCloud\Cms;

/**
 * @method string getSlsLogstore()
 * @method $this withSlsLogstore($value)
 * @method string getSlsProject()
 * @method $this withSlsProject($value)
 * @method array getValueFilter()
 * @method string getMetricExpress()
 * @method $this withMetricExpress($value)
 * @method string getSlsRegionId()
 * @method $this withSlsRegionId($value)
 * @method string getMetricName()
 * @method $this withMetricName($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getTumblingwindows()
 * @method $this withTumblingwindows($value)
 * @method string getValueFilterRelation()
 * @method $this withValueFilterRelation($value)
 * @method string getUnit()
 * @method $this withUnit($value)
 * @method array getGroupbys()
 * @method string getLogId()
 * @method $this withLogId($value)
 * @method array getAggregates()
 */
class PutLogMonitor extends Rpc
{
    /**
     * @return $this
     */
    public function withValueFilter(array $valueFilter)
    {
        $this->data['ValueFilter'] = $valueFilter;
        foreach ($valueFilter as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['ValueFilter.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['ValueFilter.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
            if (isset($depth1Value['Operator'])) {
                $this->options['query']['ValueFilter.' . ($depth1 + 1) . '.Operator'] = $depth1Value['Operator'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withGroupbys(array $groupbys)
    {
        $this->data['Groupbys'] = $groupbys;
        foreach ($groupbys as $depth1 => $depth1Value) {
            if (isset($depth1Value['FieldName'])) {
                $this->options['query']['Groupbys.' . ($depth1 + 1) . '.FieldName'] = $depth1Value['FieldName'];
            }
            if (isset($depth1Value['Alias'])) {
                $this->options['query']['Groupbys.' . ($depth1 + 1) . '.Alias'] = $depth1Value['Alias'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withAggregates(array $aggregates)
    {
        $this->data['Aggregates'] = $aggregates;
        foreach ($aggregates as $depth1 => $depth1Value) {
            if (isset($depth1Value['FieldName'])) {
                $this->options['query']['Aggregates.' . ($depth1 + 1) . '.FieldName'] = $depth1Value['FieldName'];
            }
            if (isset($depth1Value['Function'])) {
                $this->options['query']['Aggregates.' . ($depth1 + 1) . '.Function'] = $depth1Value['Function'];
            }
            if (isset($depth1Value['Alias'])) {
                $this->options['query']['Aggregates.' . ($depth1 + 1) . '.Alias'] = $depth1Value['Alias'];
            }
        }

        return $this;
    }
}
