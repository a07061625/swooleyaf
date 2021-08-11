<?php

namespace AlibabaCloud\Lubanruler;

/**
 * @method string getTaskDO()
 * @method string getToken()
 */
class CreateLubanrulerTask extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskDO($value)
    {
        $this->data['TaskDO'] = $value;
        $this->options['form_params']['TaskDO'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withToken($value)
    {
        $this->data['Token'] = $value;
        $this->options['form_params']['Token'] = $value;

        return $this;
    }
}
