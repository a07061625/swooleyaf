<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getDuration()
 * @method string getRuleType()
 * @method string getAppId()
 * @method string getUrlVar()
 * @method string getRtThreshold()
 * @method string getServiceName()
 * @method string getRuleId()
 * @method string getMethodName()
 */
class UpdateDegradeControl extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/degradeControl';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDuration($value)
    {
        $this->data['Duration'] = $value;
        $this->options['query']['Duration'] = $value;

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
    public function withRtThreshold($value)
    {
        $this->data['RtThreshold'] = $value;
        $this->options['query']['RtThreshold'] = $value;

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
    public function withRuleId($value)
    {
        $this->data['RuleId'] = $value;
        $this->options['query']['RuleId'] = $value;

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
