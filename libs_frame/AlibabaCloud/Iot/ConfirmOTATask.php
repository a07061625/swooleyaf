<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method array getTaskId()
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class ConfirmOTATask extends Rpc
{
    /**
     * @return $this
     */
    public function withTaskId(array $taskId)
    {
        $this->data['TaskId'] = $taskId;
        foreach ($taskId as $i => $iValue) {
            $this->options['query']['TaskId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

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
