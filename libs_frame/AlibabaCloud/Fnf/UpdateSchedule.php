<?php

namespace AlibabaCloud\Fnf;

/**
 * @method string getScheduleName()
 * @method string getCronExpression()
 * @method string getPayload()
 * @method string getRequestId()
 * @method $this withRequestId($value)
 * @method string getEnable()
 * @method string getDescription()
 * @method string getFlowName()
 */
class UpdateSchedule extends Rpc
{
    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScheduleName($value)
    {
        $this->data['ScheduleName'] = $value;
        $this->options['form_params']['ScheduleName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCronExpression($value)
    {
        $this->data['CronExpression'] = $value;
        $this->options['form_params']['CronExpression'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPayload($value)
    {
        $this->data['Payload'] = $value;
        $this->options['form_params']['Payload'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnable($value)
    {
        $this->data['Enable'] = $value;
        $this->options['form_params']['Enable'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFlowName($value)
    {
        $this->data['FlowName'] = $value;
        $this->options['form_params']['FlowName'] = $value;

        return $this;
    }
}
