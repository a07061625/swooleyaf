<?php

namespace AlibabaCloud\AmqpOpen;

/**
 * @method string getArgument()
 * @method string getDestinationName()
 * @method string getSourceExchange()
 * @method string getBindingKey()
 * @method string getBindingType()
 * @method string getInstanceId()
 * @method string getVirtualHost()
 */
class CreateBinding extends Rpc
{
    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withArgument($value)
    {
        $this->data['Argument'] = $value;
        $this->options['form_params']['Argument'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDestinationName($value)
    {
        $this->data['DestinationName'] = $value;
        $this->options['form_params']['DestinationName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceExchange($value)
    {
        $this->data['SourceExchange'] = $value;
        $this->options['form_params']['SourceExchange'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBindingKey($value)
    {
        $this->data['BindingKey'] = $value;
        $this->options['form_params']['BindingKey'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBindingType($value)
    {
        $this->data['BindingType'] = $value;
        $this->options['form_params']['BindingType'] = $value;

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
