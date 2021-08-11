<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getExtInfo()
 * @method string getRecordUrl()
 * @method string getEndReason()
 * @method string getSessionId()
 * @method string getFromPhoneNum()
 * @method string getInterveneTime()
 * @method string getBizType()
 * @method string getInstanceId()
 * @method string getToPhoneNum()
 * @method string getBizId()
 * @method string getTenantId()
 * @method string getCallType()
 * @method string getUserInfo()
 */
class CreateOuterCallCenterData extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtInfo($value)
    {
        $this->data['ExtInfo'] = $value;
        $this->options['form_params']['ExtInfo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRecordUrl($value)
    {
        $this->data['RecordUrl'] = $value;
        $this->options['form_params']['RecordUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndReason($value)
    {
        $this->data['EndReason'] = $value;
        $this->options['form_params']['EndReason'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInterveneTime($value)
    {
        $this->data['InterveneTime'] = $value;
        $this->options['form_params']['InterveneTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizType($value)
    {
        $this->data['BizType'] = $value;
        $this->options['form_params']['BizType'] = $value;

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
    public function withTenantId($value)
    {
        $this->data['TenantId'] = $value;
        $this->options['form_params']['TenantId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCallType($value)
    {
        $this->data['CallType'] = $value;
        $this->options['form_params']['CallType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserInfo($value)
    {
        $this->data['UserInfo'] = $value;
        $this->options['form_params']['UserInfo'] = $value;

        return $this;
    }
}
