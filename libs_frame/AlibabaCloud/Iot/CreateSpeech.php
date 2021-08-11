<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getVoice()
 * @method string getProjectCode()
 * @method string getIotInstanceId()
 * @method string getText()
 * @method string getSpeechType()
 * @method string getVolume()
 * @method string getBizCode()
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getSpeechRate()
 */
class CreateSpeech extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVoice($value)
    {
        $this->data['Voice'] = $value;
        $this->options['form_params']['Voice'] = $value;

        return $this;
    }

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
    public function withText($value)
    {
        $this->data['Text'] = $value;
        $this->options['form_params']['Text'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSpeechType($value)
    {
        $this->data['SpeechType'] = $value;
        $this->options['form_params']['SpeechType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVolume($value)
    {
        $this->data['Volume'] = $value;
        $this->options['form_params']['Volume'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizCode($value)
    {
        $this->data['BizCode'] = $value;
        $this->options['form_params']['BizCode'] = $value;

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
    public function withSpeechRate($value)
    {
        $this->data['SpeechRate'] = $value;
        $this->options['form_params']['SpeechRate'] = $value;

        return $this;
    }
}
