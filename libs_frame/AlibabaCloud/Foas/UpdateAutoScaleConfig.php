<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 * @method string getInstanceId()
 * @method string getConfigJson()
 * @method string getJobName()
 */
class UpdateAutoScaleConfig extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/jobs/[jobName]/instance/[instanceId]/autoscale/config';

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
    public function withConfigJson($value)
    {
        $this->data['ConfigJson'] = $value;
        $this->options['form_params']['configJson'] = $value;

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
