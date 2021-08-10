<?php

namespace AlibabaCloud\AmqpOpen;

/**
 * @method string getExchangeName()
 * @method string getInstanceId()
 * @method string getVirtualHost()
 */
class DeleteExchange extends Rpc
{
    /** @var string */
    public $method = 'POST';

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
    public function withVirtualHost($value)
    {
        $this->data['VirtualHost'] = $value;
        $this->options['form_params']['VirtualHost'] = $value;

        return $this;
    }
}
