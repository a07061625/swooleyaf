<?php

namespace AlibabaCloud\Lubanruler;

/**
 * @method string getAoneInfo()
 * @method string getToken()
 */
class UpdateLubanrulerTask extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAoneInfo($value)
    {
        $this->data['AoneInfo'] = $value;
        $this->options['form_params']['AoneInfo'] = $value;

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
