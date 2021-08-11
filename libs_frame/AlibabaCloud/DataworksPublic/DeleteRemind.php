<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getRemindId()
 */
class DeleteRemind extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRemindId($value)
    {
        $this->data['RemindId'] = $value;
        $this->options['form_params']['RemindId'] = $value;

        return $this;
    }
}
