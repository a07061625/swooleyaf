<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getProjectCode()
 * @method string getTemplateBizCode()
 * @method string getIotId()
 * @method string getIotInstanceId()
 * @method string getProductKey()
 * @method string getParamsJsonString()
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getDeviceName()
 */
class PrintByTemplate extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectCode($value)
    {
        $this->data['ProjectCode'] = $value;
        $this->options['form_params']['ProjectCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTemplateBizCode($value)
    {
        $this->data['TemplateBizCode'] = $value;
        $this->options['form_params']['TemplateBizCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIotId($value)
    {
        $this->data['IotId'] = $value;
        $this->options['form_params']['IotId'] = $value;

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
    public function withProductKey($value)
    {
        $this->data['ProductKey'] = $value;
        $this->options['form_params']['ProductKey'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParamsJsonString($value)
    {
        $this->data['ParamsJsonString'] = $value;
        $this->options['form_params']['ParamsJsonString'] = $value;

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
}
