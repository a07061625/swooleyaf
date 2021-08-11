<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getCancelScheduledTask()
 * @method $this withCancelScheduledTask($value)
 * @method string getJobId()
 * @method $this withJobId($value)
 * @method string getCancelUnconfirmedTask()
 * @method $this withCancelUnconfirmedTask($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getCancelQueuedTask()
 * @method $this withCancelQueuedTask($value)
 * @method string getCancelInProgressTask()
 * @method $this withCancelInProgressTask($value)
 * @method string getCancelNotifiedTask()
 * @method $this withCancelNotifiedTask($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class CancelOTATaskByJob extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
