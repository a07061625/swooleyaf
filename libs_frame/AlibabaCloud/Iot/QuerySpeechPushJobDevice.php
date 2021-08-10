<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getPageId()
 * @method string getIotInstanceId()
 * @method string getPageSize()
 * @method string getApiProduct()
 * @method string getJobCode()
 * @method string getApiRevision()
 * @method string getDeviceName()
 * @method string getStatus()
 */
class QuerySpeechPushJobDevice extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageId($value)
    {
        $this->data['PageId'] = $value;
        $this->options['form_params']['PageId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIotInstanceId($value)
    {
        $this->data['IotInstanceId'] = $value;
        $this->options['form_params']['IotInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJobCode($value)
    {
        $this->data['JobCode'] = $value;
        $this->options['form_params']['JobCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceName($value)
    {
        $this->data['DeviceName'] = $value;
        $this->options['form_params']['DeviceName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatus($value)
    {
        $this->data['Status'] = $value;
        $this->options['form_params']['Status'] = $value;

        return $this;
    }
}
