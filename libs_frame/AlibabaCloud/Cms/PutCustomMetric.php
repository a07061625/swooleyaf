<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getMetricList()
 */
class PutCustomMetric extends Rpc
{
    /**
     * @return $this
     */
    public function withMetricList(array $metricList)
    {
        $this->data['MetricList'] = $metricList;
        foreach ($metricList as $depth1 => $depth1Value) {
            if (isset($depth1Value['Period'])) {
                $this->options['query']['MetricList.' . ($depth1 + 1) . '.Period'] = $depth1Value['Period'];
            }
            if (isset($depth1Value['GroupId'])) {
                $this->options['query']['MetricList.' . ($depth1 + 1) . '.GroupId'] = $depth1Value['GroupId'];
            }
            if (isset($depth1Value['Values'])) {
                $this->options['query']['MetricList.' . ($depth1 + 1) . '.Values'] = $depth1Value['Values'];
            }
            if (isset($depth1Value['Time'])) {
                $this->options['query']['MetricList.' . ($depth1 + 1) . '.Time'] = $depth1Value['Time'];
            }
            if (isset($depth1Value['MetricName'])) {
                $this->options['query']['MetricList.' . ($depth1 + 1) . '.MetricName'] = $depth1Value['MetricName'];
            }
            if (isset($depth1Value['Type'])) {
                $this->options['query']['MetricList.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
            }
            if (isset($depth1Value['Dimensions'])) {
                $this->options['query']['MetricList.' . ($depth1 + 1) . '.Dimensions'] = $depth1Value['Dimensions'];
            }
        }

        return $this;
    }
}
