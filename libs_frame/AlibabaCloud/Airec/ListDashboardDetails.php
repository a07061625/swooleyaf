<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getMetricType()
 * @method string getInstanceId()
 * @method string getExperimentIds()
 * @method string getTraceIds()
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getSceneIds()
 */
class ListDashboardDetails extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/dashboard/details';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMetricType($value)
    {
        $this->data['MetricType'] = $value;
        $this->options['query']['metricType'] = $value;

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
        $this->pathParameters['instanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExperimentIds($value)
    {
        $this->data['ExperimentIds'] = $value;
        $this->options['query']['experimentIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTraceIds($value)
    {
        $this->data['TraceIds'] = $value;
        $this->options['query']['traceIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndTime($value)
    {
        $this->data['EndTime'] = $value;
        $this->options['query']['endTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartTime($value)
    {
        $this->data['StartTime'] = $value;
        $this->options['query']['startTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSceneIds($value)
    {
        $this->data['SceneIds'] = $value;
        $this->options['query']['sceneIds'] = $value;

        return $this;
    }
}
