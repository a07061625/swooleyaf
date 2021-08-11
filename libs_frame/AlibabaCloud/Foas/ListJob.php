<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getQueueName()
 * @method string getProjectName()
 * @method string getPageSize()
 * @method string getIsShowFullField()
 * @method string getPageIndex()
 * @method string getEngineVersion()
 * @method string getClusterId()
 * @method string getJobType()
 * @method string getApiType()
 * @method string getJobName()
 * @method string getFolderId()
 */
class ListJob extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/jobs';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withQueueName($value)
    {
        $this->data['QueueName'] = $value;
        $this->options['query']['queueName'] = $value;

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
    public function withIsShowFullField($value)
    {
        $this->data['IsShowFullField'] = $value;
        $this->options['query']['isShowFullField'] = $value;

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
    public function withEngineVersion($value)
    {
        $this->data['EngineVersion'] = $value;
        $this->options['query']['engineVersion'] = $value;

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
        $this->options['query']['clusterId'] = $value;

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
    public function withJobName($value)
    {
        $this->data['JobName'] = $value;
        $this->options['query']['jobName'] = $value;

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
        $this->options['query']['folderId'] = $value;

        return $this;
    }
}
