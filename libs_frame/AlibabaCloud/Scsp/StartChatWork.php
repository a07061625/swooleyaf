<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getInstanceId()
 * @method string getAccountName()
 * @method string getStationType()
 * @method string getWorkType()
 * @method string getUserAgent()
 */
class StartChatWork extends Rpc
{
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
    public function withAccountName($value)
    {
        $this->data['AccountName'] = $value;
        $this->options['form_params']['AccountName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStationType($value)
    {
        $this->data['StationType'] = $value;
        $this->options['form_params']['StationType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWorkType($value)
    {
        $this->data['WorkType'] = $value;
        $this->options['form_params']['WorkType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserAgent($value)
    {
        $this->data['UserAgent'] = $value;
        $this->options['form_params']['UserAgent'] = $value;

        return $this;
    }
}
