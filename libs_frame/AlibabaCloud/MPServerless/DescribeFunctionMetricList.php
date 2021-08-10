<?php

namespace AlibabaCloud\MPServerless;

/**
 * @method string getPeriod()
 * @method string getLength()
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getSpaceId()
 * @method string getNextToken()
 * @method string getFunctionName()
 * @method string getMetricName()
 */
class DescribeFunctionMetricList extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPeriod($value)
    {
        $this->data['Period'] = $value;
        $this->options['form_params']['Period'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLength($value)
    {
        $this->data['Length'] = $value;
        $this->options['form_params']['Length'] = $value;

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
        $this->options['form_params']['EndTime'] = $value;

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
        $this->options['form_params']['StartTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSpaceId($value)
    {
        $this->data['SpaceId'] = $value;
        $this->options['form_params']['SpaceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNextToken($value)
    {
        $this->data['NextToken'] = $value;
        $this->options['form_params']['NextToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFunctionName($value)
    {
        $this->data['FunctionName'] = $value;
        $this->options['form_params']['FunctionName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMetricName($value)
    {
        $this->data['MetricName'] = $value;
        $this->options['form_params']['MetricName'] = $value;

        return $this;
    }
}
