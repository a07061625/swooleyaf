<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getExtAttrStr()
 * @method string getMinUid()
 * @method string getThirdMsgId()
 * @method string getValidTimeEnd()
 * @method string getPayload()
 * @method string getUids()
 * @method string getAppMinVersion()
 * @method string getValidTimeStart()
 * @method string getMaxUid()
 * @method string getOsType()
 * @method string getBizType()
 * @method string getAppMaxVersion()
 * @method string getAppId()
 * @method string getWorkspaceId()
 */
class CreateOpenGlobalData extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtAttrStr($value)
    {
        $this->data['ExtAttrStr'] = $value;
        $this->options['form_params']['ExtAttrStr'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMinUid($value)
    {
        $this->data['MinUid'] = $value;
        $this->options['form_params']['MinUid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withThirdMsgId($value)
    {
        $this->data['ThirdMsgId'] = $value;
        $this->options['form_params']['ThirdMsgId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withValidTimeEnd($value)
    {
        $this->data['ValidTimeEnd'] = $value;
        $this->options['form_params']['ValidTimeEnd'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPayload($value)
    {
        $this->data['Payload'] = $value;
        $this->options['form_params']['Payload'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUids($value)
    {
        $this->data['Uids'] = $value;
        $this->options['form_params']['Uids'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppMinVersion($value)
    {
        $this->data['AppMinVersion'] = $value;
        $this->options['form_params']['AppMinVersion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withValidTimeStart($value)
    {
        $this->data['ValidTimeStart'] = $value;
        $this->options['form_params']['ValidTimeStart'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxUid($value)
    {
        $this->data['MaxUid'] = $value;
        $this->options['form_params']['MaxUid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOsType($value)
    {
        $this->data['OsType'] = $value;
        $this->options['form_params']['OsType'] = $value;

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
    public function withAppMaxVersion($value)
    {
        $this->data['AppMaxVersion'] = $value;
        $this->options['form_params']['AppMaxVersion'] = $value;

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
    public function withWorkspaceId($value)
    {
        $this->data['WorkspaceId'] = $value;
        $this->options['form_params']['WorkspaceId'] = $value;

        return $this;
    }
}
