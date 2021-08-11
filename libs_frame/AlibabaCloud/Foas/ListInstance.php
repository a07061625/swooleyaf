<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 * @method string getEndBeginTs()
 * @method string getExpectState()
 * @method string getJobType()
 * @method string getApiType()
 * @method string getActualState()
 * @method string getEndEndTs()
 * @method string getStartEndTs()
 * @method string getPageSize()
 * @method string getStartBeginTs()
 * @method string getPageIndex()
 * @method string getIsArchived()
 * @method string getJobName()
 */
class ListInstance extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/instances';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectName($value)
    {
        $this->data['ProjectName'] = $value;
        $this->pathParameters['projectName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndBeginTs($value)
    {
        $this->data['EndBeginTs'] = $value;
        $this->options['query']['endBeginTs'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExpectState($value)
    {
        $this->data['ExpectState'] = $value;
        $this->options['query']['expectState'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJobType($value)
    {
        $this->data['JobType'] = $value;
        $this->options['query']['jobType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiType($value)
    {
        $this->data['ApiType'] = $value;
        $this->options['query']['apiType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withActualState($value)
    {
        $this->data['ActualState'] = $value;
        $this->options['query']['actualState'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndEndTs($value)
    {
        $this->data['EndEndTs'] = $value;
        $this->options['query']['endEndTs'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartEndTs($value)
    {
        $this->data['StartEndTs'] = $value;
        $this->options['query']['startEndTs'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['query']['pageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartBeginTs($value)
    {
        $this->data['StartBeginTs'] = $value;
        $this->options['query']['startBeginTs'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageIndex($value)
    {
        $this->data['PageIndex'] = $value;
        $this->options['query']['pageIndex'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsArchived($value)
    {
        $this->data['IsArchived'] = $value;
        $this->options['query']['isArchived'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJobName($value)
    {
        $this->data['JobName'] = $value;
        $this->options['query']['jobName'] = $value;

        return $this;
    }
}
