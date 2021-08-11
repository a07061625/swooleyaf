<?php

namespace AlibabaCloud\Videosearch;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getVideoId()
 * @method string getInstanceId()
 */
class AddDeletionVideoTask extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVideoId($value)
    {
        $this->data['VideoId'] = $value;
        $this->options['form_params']['VideoId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->options['form_params']['InstanceId'] = $value;

        return $this;
    }
}
