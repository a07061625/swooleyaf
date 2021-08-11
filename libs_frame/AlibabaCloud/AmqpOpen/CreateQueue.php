<?php

namespace AlibabaCloud\AmqpOpen;

/**
 * @method string getQueueName()
 * @method string getDeadLetterRoutingKey()
 * @method string getMaxLength()
 * @method string getAutoExpireState()
 * @method string getDeadLetterExchange()
 * @method string getInstanceId()
 * @method string getExclusiveState()
 * @method string getAutoDeleteState()
 * @method string getMessageTTL()
 * @method string getVirtualHost()
 * @method string getMaximumPriority()
 */
class CreateQueue extends Rpc
{
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
        $this->options['form_params']['QueueName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeadLetterRoutingKey($value)
    {
        $this->data['DeadLetterRoutingKey'] = $value;
        $this->options['form_params']['DeadLetterRoutingKey'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxLength($value)
    {
        $this->data['MaxLength'] = $value;
        $this->options['form_params']['MaxLength'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAutoExpireState($value)
    {
        $this->data['AutoExpireState'] = $value;
        $this->options['form_params']['AutoExpireState'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeadLetterExchange($value)
    {
        $this->data['DeadLetterExchange'] = $value;
        $this->options['form_params']['DeadLetterExchange'] = $value;

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
        $this->options['form_params']['InstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExclusiveState($value)
    {
        $this->data['ExclusiveState'] = $value;
        $this->options['form_params']['ExclusiveState'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAutoDeleteState($value)
    {
        $this->data['AutoDeleteState'] = $value;
        $this->options['form_params']['AutoDeleteState'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMessageTTL($value)
    {
        $this->data['MessageTTL'] = $value;
        $this->options['form_params']['MessageTTL'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVirtualHost($value)
    {
        $this->data['VirtualHost'] = $value;
        $this->options['form_params']['VirtualHost'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaximumPriority($value)
    {
        $this->data['MaximumPriority'] = $value;
        $this->options['form_params']['MaximumPriority'] = $value;

        return $this;
    }
}
