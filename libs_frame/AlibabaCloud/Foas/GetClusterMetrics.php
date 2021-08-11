<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getClusterId()
 * @method string getMetricJson()
 */
class GetClusterMetrics extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/clusters/[clusterId]/metrics';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->pathParameters['clusterId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMetricJson($value)
    {
        $this->data['MetricJson'] = $value;
        $this->options['form_params']['metricJson'] = $value;

        return $this;
    }
}
