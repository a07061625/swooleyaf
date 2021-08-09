<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of PutCustomMetric
 *
 * @method array getMetricLists()
 */
class PutCustomMetricRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Cms',
            '2019-01-01',
            'PutCustomMetric',
            'cms'
        );
    }

    /**
     * @return $this
     */
    public function setMetricLists(array $metricList)
    {
        $this->requestParameters['MetricLists'] = $metricList;
        foreach ($metricList as $depth1 => $depth1Value) {
            $this->queryParameters['MetricList.' . ($depth1 + 1) . '.Period'] = $depth1Value['Period'];
            $this->queryParameters['MetricList.' . ($depth1 + 1) . '.GroupId'] = $depth1Value['GroupId'];
            $this->queryParameters['MetricList.' . ($depth1 + 1) . '.Values'] = $depth1Value['Values'];
            $this->queryParameters['MetricList.' . ($depth1 + 1) . '.Time'] = $depth1Value['Time'];
            $this->queryParameters['MetricList.' . ($depth1 + 1) . '.MetricName'] = $depth1Value['MetricName'];
            $this->queryParameters['MetricList.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
            $this->queryParameters['MetricList.' . ($depth1 + 1) . '.Dimensions'] = $depth1Value['Dimensions'];
        }

        return $this;
    }
}
