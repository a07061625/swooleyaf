<?php

namespace AlibabaCloud\AmqpOpen;

/**
 * @method string getInternal()
 * @method string getExchangeName()
 * @method string getInstanceId()
 * @method string getAlternateExchange()
 * @method string getAutoDeleteState()
 * @method string getExchangeType()
 * @method string getVirtualHost()
 */
class CreateExchange extends Rpc
{
    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInternal($value)
    {
        $this->data['Internal'] = $value;
        $this->options['form_params']['Internal'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExchangeName($value)
    {
        $this->data['ExchangeName'] = $value;
        $this->options['form_params']['ExchangeName'] = $value;

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
    public function withAlternateExchange($value)
    {
        $this->data['AlternateExchange'] = $value;
        $this->options['form_params']['AlternateExchange'] = $value;

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
    public function withExchangeType($value)
    {
        $this->data['ExchangeType'] = $value;
        $this->options['form_params']['ExchangeType'] = $value;

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
}
