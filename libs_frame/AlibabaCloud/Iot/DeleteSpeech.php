<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getIotInstanceId()
 * @method array getSpeechCodeList()
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class DeleteSpeech extends Rpc
{
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
     * @return $this
     */
    public function withSpeechCodeList(array $speechCodeList)
    {
        $this->data['SpeechCodeList'] = $speechCodeList;
        foreach ($speechCodeList as $i => $iValue) {
            $this->options['form_params']['SpeechCodeList.' . ($i + 1)] = $iValue;
        }

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
