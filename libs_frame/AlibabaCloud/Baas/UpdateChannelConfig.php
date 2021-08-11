<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getMaxMessageCount()
 * @method string getPreferredMaxBytes()
 * @method string getBatchTimeout()
 * @method string getChannelId()
 */
class UpdateChannelConfig extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxMessageCount($value)
    {
        $this->data['MaxMessageCount'] = $value;
        $this->options['form_params']['MaxMessageCount'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPreferredMaxBytes($value)
    {
        $this->data['PreferredMaxBytes'] = $value;
        $this->options['form_params']['PreferredMaxBytes'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBatchTimeout($value)
    {
        $this->data['BatchTimeout'] = $value;
        $this->options['form_params']['BatchTimeout'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChannelId($value)
    {
        $this->data['ChannelId'] = $value;
        $this->options['form_params']['ChannelId'] = $value;

        return $this;
    }
}
