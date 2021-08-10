<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getSize()
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getPage()
 * @method string getDetail()
 * @method string getTrigger()
 * @method string getLang()
 */
class ListDiagnoseReport extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/diagnosis/instances/[InstanceId]/reports';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSize($value)
    {
        $this->data['Size'] = $value;
        $this->options['query']['size'] = $value;

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
    public function withPage($value)
    {
        $this->data['Page'] = $value;
        $this->options['query']['page'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDetail($value)
    {
        $this->data['Detail'] = $value;
        $this->options['query']['detail'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTrigger($value)
    {
        $this->data['Trigger'] = $value;
        $this->options['query']['trigger'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLang($value)
    {
        $this->data['Lang'] = $value;
        $this->options['query']['lang'] = $value;

        return $this;
    }
}
