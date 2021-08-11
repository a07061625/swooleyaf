<?php

namespace AlibabaCloud\Alimt;

/**
 * @method string getTaskId()
 */
class GetImageTranslateTask extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskId($value)
    {
        $this->data['TaskId'] = $value;
        $this->options['form_params']['TaskId'] = $value;

        return $this;
    }
}
