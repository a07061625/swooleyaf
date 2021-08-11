<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getIsFlush()
 * @method string getProjectName()
 * @method string getInstanceId()
 * @method string getExpectState()
 * @method string getJobName()
 */
class ModifyInstanceState extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/jobs/[jobName]/instances/[instanceId]/expectstate';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsFlush($value)
    {
        $this->data['IsFlush'] = $value;
        $this->options['form_params']['isFlush'] = $value;

        return $this;
    }

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
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->pathParameters['instanceId'] = $value;

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
        $this->options['form_params']['expectState'] = $value;

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
