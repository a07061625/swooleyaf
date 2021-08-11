<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getQueueName()
 * @method string getProjectName()
 * @method string getCode()
 * @method string getDescription()
 * @method string getEngineVersion()
 * @method string getClusterId()
 * @method string getPackages()
 * @method string getJobType()
 * @method string getApiType()
 * @method string getFolderId()
 * @method string getPlanJson()
 * @method string getProperties()
 * @method string getJobName()
 */
class CreateJob extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/jobs';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withQueueName($value)
    {
        $this->data['QueueName'] = $value;
        $this->options['form_params']['queueName'] = $value;

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
    public function withCode($value)
    {
        $this->data['Code'] = $value;
        $this->options['form_params']['code'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEngineVersion($value)
    {
        $this->data['EngineVersion'] = $value;
        $this->options['form_params']['engineVersion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->options['form_params']['clusterId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPackages($value)
    {
        $this->data['Packages'] = $value;
        $this->options['form_params']['packages'] = $value;

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
        $this->options['form_params']['jobType'] = $value;

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
        $this->options['form_params']['apiType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFolderId($value)
    {
        $this->data['FolderId'] = $value;
        $this->options['form_params']['folderId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPlanJson($value)
    {
        $this->data['PlanJson'] = $value;
        $this->options['form_params']['planJson'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProperties($value)
    {
        $this->data['Properties'] = $value;
        $this->options['form_params']['properties'] = $value;

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
        $this->options['form_params']['jobName'] = $value;

        return $this;
    }
}
