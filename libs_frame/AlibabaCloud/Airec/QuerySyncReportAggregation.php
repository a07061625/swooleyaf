<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 * @method string getEndTime()
 * @method string getStartTime()
 */
class QuerySyncReportAggregation extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/sync-reports/aggregation';

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
}
