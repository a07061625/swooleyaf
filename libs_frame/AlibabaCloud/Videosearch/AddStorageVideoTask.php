<?php

namespace AlibabaCloud\Videosearch;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getVideoTags()
 * @method string getVideoId()
 * @method string getInstanceId()
 * @method string getVideoUrl()
 * @method string getCallbackUrl()
 */
class AddStorageVideoTask extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVideoTags($value)
    {
        $this->data['VideoTags'] = $value;
        $this->options['form_params']['VideoTags'] = $value;

        return $this;
    }

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVideoUrl($value)
    {
        $this->data['VideoUrl'] = $value;
        $this->options['form_params']['VideoUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCallbackUrl($value)
    {
        $this->data['CallbackUrl'] = $value;
        $this->options['form_params']['CallbackUrl'] = $value;

        return $this;
    }
}
