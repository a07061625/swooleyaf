<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 * @method string getLevelType()
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getType()
 * @method string getKey()
 */
class DescribeSyncReportOutliers extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/sync-reports/outliers';

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
    public function withLevelType($value)
    {
        $this->data['LevelType'] = $value;
        $this->options['query']['levelType'] = $value;

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
    public function withType($value)
    {
        $this->data['Type'] = $value;
        $this->options['query']['type'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withKey($value)
    {
        $this->data['Key'] = $value;
        $this->options['query']['key'] = $value;

        return $this;
    }
}
