<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCorpId()
 * @method string getLiveVideoSummary()
 * @method string getStartTimeStamp()
 * @method string getDeviceId()
 * @method string getEndTimeStamp()
 * @method string getOptionList()
 */
class CreateVideoSummaryTask extends Rpc
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
    public function withLiveVideoSummary($value)
    {
        $this->data['LiveVideoSummary'] = $value;
        $this->options['form_params']['LiveVideoSummary'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartTimeStamp($value)
    {
        $this->data['StartTimeStamp'] = $value;
        $this->options['form_params']['StartTimeStamp'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceId($value)
    {
        $this->data['DeviceId'] = $value;
        $this->options['form_params']['DeviceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndTimeStamp($value)
    {
        $this->data['EndTimeStamp'] = $value;
        $this->options['form_params']['EndTimeStamp'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOptionList($value)
    {
        $this->data['OptionList'] = $value;
        $this->options['form_params']['OptionList'] = $value;

        return $this;
    }
}
