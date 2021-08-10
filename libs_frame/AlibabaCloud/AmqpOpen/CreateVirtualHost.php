<?php

namespace AlibabaCloud\AmqpOpen;

/**
 * @method string getInstanceId()
 * @method string getVirtualHost()
 */
class CreateVirtualHost extends Rpc
{
    /** @var string */
    public $method = 'POST';

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
