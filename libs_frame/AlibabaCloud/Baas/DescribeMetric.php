<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getPeriod()
 * @method string getMetric()
 * @method string getPort()
 * @method string getBizid()
 * @method $this withBizid($value)
 * @method string getTimeArea()
 * @method string getInnerIp()
 */
class DescribeMetric extends Rpc
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
    public function withMetric($value)
    {
        $this->data['Metric'] = $value;
        $this->options['form_params']['Metric'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPort($value)
    {
        $this->data['Port'] = $value;
        $this->options['form_params']['Port'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTimeArea($value)
    {
        $this->data['TimeArea'] = $value;
        $this->options['form_params']['TimeArea'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInnerIp($value)
    {
        $this->data['InnerIp'] = $value;
        $this->options['form_params']['InnerIp'] = $value;

        return $this;
    }
}
