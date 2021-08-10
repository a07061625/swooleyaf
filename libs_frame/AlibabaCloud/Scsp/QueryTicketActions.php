<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getInstanceId()
 * @method string getTicketId()
 * @method array getActionCodeList()
 */
class QueryTicketActions extends Rpc
{
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
     * @return $this
     */
    public function withActionCodeList(array $actionCodeList)
    {
        $this->data['ActionCodeList'] = $actionCodeList;
        foreach ($actionCodeList as $i => $iValue) {
            $this->options['form_params']['ActionCodeList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
