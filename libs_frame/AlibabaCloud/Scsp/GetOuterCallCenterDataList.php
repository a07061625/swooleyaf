<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getQueryEndTime()
 * @method string getInstanceId()
 * @method string getToPhoneNum()
 * @method string getQueryStartTime()
 * @method string getBizId()
 * @method string getSessionId()
 * @method string getFromPhoneNum()
 */
class GetOuterCallCenterDataList extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withQueryEndTime($value)
    {
        $this->data['QueryEndTime'] = $value;
        $this->options['form_params']['QueryEndTime'] = $value;

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
    public function withToPhoneNum($value)
    {
        $this->data['ToPhoneNum'] = $value;
        $this->options['form_params']['ToPhoneNum'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withQueryStartTime($value)
    {
        $this->data['QueryStartTime'] = $value;
        $this->options['form_params']['QueryStartTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizId($value)
    {
        $this->data['BizId'] = $value;
        $this->options['form_params']['BizId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSessionId($value)
    {
        $this->data['SessionId'] = $value;
        $this->options['form_params']['SessionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFromPhoneNum($value)
    {
        $this->data['FromPhoneNum'] = $value;
        $this->options['form_params']['FromPhoneNum'] = $value;

        return $this;
    }
}
