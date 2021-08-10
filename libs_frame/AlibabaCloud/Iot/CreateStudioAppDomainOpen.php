<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getProtocol()
 * @method string getIotInstanceId()
 * @method string getHost()
 * @method string getProjectId()
 * @method string getAppId()
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class CreateStudioAppDomainOpen extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProtocol($value)
    {
        $this->data['Protocol'] = $value;
        $this->options['form_params']['Protocol'] = $value;

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
    public function withHost($value)
    {
        $this->data['Host'] = $value;
        $this->options['form_params']['Host'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['form_params']['AppId'] = $value;

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
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
