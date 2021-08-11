<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getConsumerAppId()
 * @method string getGranularity()
 * @method string getRuleType()
 * @method string getAppId()
 * @method string getUrlVar()
 * @method string getServiceName()
 * @method string getThreshold()
 * @method string getStrategy()
 * @method string getMethodName()
 */
class InsertFlowControl extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/flowControl';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConsumerAppId($value)
    {
        $this->data['ConsumerAppId'] = $value;
        $this->options['query']['ConsumerAppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGranularity($value)
    {
        $this->data['Granularity'] = $value;
        $this->options['query']['Granularity'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRuleType($value)
    {
        $this->data['RuleType'] = $value;
        $this->options['query']['RuleType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUrlVar($value)
    {
        $this->data['UrlVar'] = $value;
        $this->options['query']['UrlVar'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceName($value)
    {
        $this->data['ServiceName'] = $value;
        $this->options['query']['ServiceName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withThreshold($value)
    {
        $this->data['Threshold'] = $value;
        $this->options['query']['Threshold'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStrategy($value)
    {
        $this->data['Strategy'] = $value;
        $this->options['query']['Strategy'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMethodName($value)
    {
        $this->data['MethodName'] = $value;
        $this->options['query']['MethodName'] = $value;

        return $this;
    }
}
