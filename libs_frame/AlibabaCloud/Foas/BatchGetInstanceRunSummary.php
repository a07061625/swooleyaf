<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 * @method string getJobNames()
 * @method string getJobType()
 */
class BatchGetInstanceRunSummary extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/runsummary';

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
    public function withJobNames($value)
    {
        $this->data['JobNames'] = $value;
        $this->options['query']['jobNames'] = $value;

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
}
