<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getClientToken()
 * @method string getInstanceId()
 * @method string getTicketId()
 * @method string getOperatorId()
 * @method string getFormData()
 */
class UpdateTicket extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['form_params']['ClientToken'] = $value;

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
    public function withTicketId($value)
    {
        $this->data['TicketId'] = $value;
        $this->options['form_params']['TicketId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOperatorId($value)
    {
        $this->data['OperatorId'] = $value;
        $this->options['form_params']['OperatorId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFormData($value)
    {
        $this->data['FormData'] = $value;
        $this->options['form_params']['FormData'] = $value;

        return $this;
    }
}
