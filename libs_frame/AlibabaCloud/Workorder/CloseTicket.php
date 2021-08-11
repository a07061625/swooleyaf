<?php

namespace AlibabaCloud\Workorder;

/**
 * @method string getTicketId()
 */
class CloseTicket extends Rpc
{
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
