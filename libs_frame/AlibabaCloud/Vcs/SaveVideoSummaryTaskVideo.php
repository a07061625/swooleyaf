<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCorpId()
 * @method string getSaveVideo()
 * @method string getTaskId()
 */
class SaveVideoSummaryTaskVideo extends Rpc
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
    public function withSaveVideo($value)
    {
        $this->data['SaveVideo'] = $value;
        $this->options['form_params']['SaveVideo'] = $value;

        return $this;
    }

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
