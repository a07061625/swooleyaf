<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getMetric()
 * @method string getAggregator()
 * @method string getStart()
 * @method string getEnd()
 * @method string getInterval()
 * @method string getTags()
 */
class QueryMonitorInfo extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/monitor/queryMonitorInfo';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMetric($value)
    {
        $this->data['Metric'] = $value;
        $this->options['query']['Metric'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAggregator($value)
    {
        $this->data['Aggregator'] = $value;
        $this->options['query']['Aggregator'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStart($value)
    {
        $this->data['Start'] = $value;
        $this->options['query']['Start'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnd($value)
    {
        $this->data['End'] = $value;
        $this->options['query']['End'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInterval($value)
    {
        $this->data['Interval'] = $value;
        $this->options['query']['Interval'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTags($value)
    {
        $this->data['Tags'] = $value;
        $this->options['query']['Tags'] = $value;

        return $this;
    }
}
