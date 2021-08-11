<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCorpId()
 * @method string getTaskRequestId()
 */
class GetVideoComposeResult extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskRequestId($value)
    {
        $this->data['TaskRequestId'] = $value;
        $this->options['form_params']['TaskRequestId'] = $value;

        return $this;
    }
}
