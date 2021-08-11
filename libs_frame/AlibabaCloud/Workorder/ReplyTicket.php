<?php

namespace AlibabaCloud\Workorder;

/**
 * @method string getContent()
 * @method string getEncrypt()
 * @method string getTicketId()
 */
class ReplyTicket extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContent($value)
    {
        $this->data['Content'] = $value;
        $this->options['form_params']['Content'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEncrypt($value)
    {
        $this->data['Encrypt'] = $value;
        $this->options['form_params']['Encrypt'] = $value;

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
}
