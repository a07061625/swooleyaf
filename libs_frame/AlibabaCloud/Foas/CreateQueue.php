<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getQueueName()
 * @method string getMaxMemMB()
 * @method string getClusterId()
 * @method string getGpu()
 * @method string getMaxVcore()
 */
class CreateQueue extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/clusters/[clusterId]/queue';

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
    public function withMaxMemMB($value)
    {
        $this->data['MaxMemMB'] = $value;
        $this->options['form_params']['maxMemMB'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGpu($value)
    {
        $this->data['Gpu'] = $value;
        $this->options['form_params']['gpu'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxVcore($value)
    {
        $this->data['MaxVcore'] = $value;
        $this->options['form_params']['maxVcore'] = $value;

        return $this;
    }
}
