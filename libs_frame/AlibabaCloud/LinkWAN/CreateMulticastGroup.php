<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getClassMode()
 * @method string getFrequency()
 * @method string getLoraVersion()
 * @method string getPeriodicity()
 * @method string getDataRate()
 */
class CreateMulticastGroup extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClassMode($value)
    {
        $this->data['ClassMode'] = $value;
        $this->options['form_params']['ClassMode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFrequency($value)
    {
        $this->data['Frequency'] = $value;
        $this->options['form_params']['Frequency'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLoraVersion($value)
    {
        $this->data['LoraVersion'] = $value;
        $this->options['form_params']['LoraVersion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPeriodicity($value)
    {
        $this->data['Periodicity'] = $value;
        $this->options['form_params']['Periodicity'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataRate($value)
    {
        $this->data['DataRate'] = $value;
        $this->options['form_params']['DataRate'] = $value;

        return $this;
    }
}
