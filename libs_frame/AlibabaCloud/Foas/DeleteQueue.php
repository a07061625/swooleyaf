<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getQueueName()
 * @method string getClusterId()
 */
class DeleteQueue extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/clusters/[clusterId]/queue';

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
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->pathParameters['clusterId'] = $value;

        return $this;
    }
}
