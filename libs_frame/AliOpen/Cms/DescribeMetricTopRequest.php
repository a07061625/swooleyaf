<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeMetricTop
 *
 * @method string getPeriod()
 * @method string getNamespace()
 * @method string getLength()
 * @method string getEndTime()
 * @method string getOrderby()
 * @method string getExpress()
 * @method string getStartTime()
 * @method string getMetricName()
 * @method string getDimensions()
 * @method string getOrderDesc()
 */
class DescribeMetricTopRequest extends RpcAcsRequest
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
            'DescribeMetricTop',
            'cms'
        );
    }

    /**
     * @param string $period
     *
     * @return $this
     */
    public function setPeriod($period)
    {
        $this->requestParameters['Period'] = $period;
        $this->queryParameters['Period'] = $period;

        return $this;
    }

    /**
     * @param string $namespace
     *
     * @return $this
     */
    public function setNamespace($namespace)
    {
        $this->requestParameters['Namespace'] = $namespace;
        $this->queryParameters['Namespace'] = $namespace;

        return $this;
    }

    /**
     * @param string $length
     *
     * @return $this
     */
    public function setLength($length)
    {
        $this->requestParameters['Length'] = $length;
        $this->queryParameters['Length'] = $length;

        return $this;
    }

    /**
     * @param string $endTime
     *
     * @return $this
     */
    public function setEndTime($endTime)
    {
        $this->requestParameters['EndTime'] = $endTime;
        $this->queryParameters['EndTime'] = $endTime;

        return $this;
    }

    /**
     * @param string $orderby
     *
     * @return $this
     */
    public function setOrderby($orderby)
    {
        $this->requestParameters['Orderby'] = $orderby;
        $this->queryParameters['Orderby'] = $orderby;

        return $this;
    }

    /**
     * @param string $express
     *
     * @return $this
     */
    public function setExpress($express)
    {
        $this->requestParameters['Express'] = $express;
        $this->queryParameters['Express'] = $express;

        return $this;
    }

    /**
     * @param string $startTime
     *
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->requestParameters['StartTime'] = $startTime;
        $this->queryParameters['StartTime'] = $startTime;

        return $this;
    }

    /**
     * @param string $metricName
     *
     * @return $this
     */
    public function setMetricName($metricName)
    {
        $this->requestParameters['MetricName'] = $metricName;
        $this->queryParameters['MetricName'] = $metricName;

        return $this;
    }

    /**
     * @param string $dimensions
     *
     * @return $this
     */
    public function setDimensions($dimensions)
    {
        $this->requestParameters['Dimensions'] = $dimensions;
        $this->queryParameters['Dimensions'] = $dimensions;

        return $this;
    }

    /**
     * @param string $orderDesc
     *
     * @return $this
     */
    public function setOrderDesc($orderDesc)
    {
        $this->requestParameters['OrderDesc'] = $orderDesc;
        $this->queryParameters['OrderDesc'] = $orderDesc;

        return $this;
    }
}
