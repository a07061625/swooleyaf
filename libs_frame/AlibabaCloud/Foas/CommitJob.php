<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 * @method string getMaxCU()
 * @method string getConfigure()
 * @method string getIsOnOff()
 * @method string getJobName()
 */
class CommitJob extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/jobs/[jobName]/commit';

    /** @var string */
    public $method = 'PUT';

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
    public function withMaxCU($value)
    {
        $this->data['MaxCU'] = $value;
        $this->options['form_params']['maxCU'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConfigure($value)
    {
        $this->data['Configure'] = $value;
        $this->options['form_params']['configure'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsOnOff($value)
    {
        $this->data['IsOnOff'] = $value;
        $this->options['form_params']['isOnOff'] = $value;

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
}
