<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 * @method string getInstanceId()
 * @method string getMetricJson()
 * @method string getJobName()
 */
class GetInstanceMetric extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/jobs/[jobName]/metric';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectName($value)
    {
        $this->data['ProjectName'] = $value;
        $this->pathParameters['projectName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->options['query']['instanceId'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJobName($value)
    {
        $this->data['JobName'] = $value;
        $this->pathParameters['jobName'] = $value;

        return $this;
    }
}
