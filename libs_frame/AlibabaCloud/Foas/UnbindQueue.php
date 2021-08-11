<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getQueueName()
 * @method string getProjectName()
 * @method string getClusterId()
 */
class UnbindQueue extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/queue';

    /** @var string */
    public $method = 'DELETE';

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
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->options['query']['clusterId'] = $value;

        return $this;
    }
}
