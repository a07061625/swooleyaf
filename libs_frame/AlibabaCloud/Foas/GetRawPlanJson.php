<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 * @method string getExpectedGB()
 * @method string getExpectedCore()
 * @method string getJobName()
 * @method string getAutoconfEnable()
 */
class GetRawPlanJson extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/jobs/[jobName]/planjson';

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
    public function withExpectedGB($value)
    {
        $this->data['ExpectedGB'] = $value;
        $this->options['query']['expectedGB'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExpectedCore($value)
    {
        $this->data['ExpectedCore'] = $value;
        $this->options['query']['expectedCore'] = $value;

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
        $this->pathParameters['jobName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAutoconfEnable($value)
    {
        $this->data['AutoconfEnable'] = $value;
        $this->options['query']['autoconfEnable'] = $value;

        return $this;
    }
}
