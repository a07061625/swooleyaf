<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getTenantId()
 * @method string getBizRequestId()
 * @method string getBizName()
 * @method string getBizAppCode()
 * @method string getRoomId()
 * @method string getRecordId()
 * @method string getS()
 * @method string getAppId()
 * @method string getMediaType()
 * @method string getWorkspaceId()
 */
class DeleteMpaasMrtcArtvcRecordfile extends Rpc
{
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
    public function withBizRequestId($value)
    {
        $this->data['BizRequestId'] = $value;
        $this->options['form_params']['BizRequestId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizName($value)
    {
        $this->data['BizName'] = $value;
        $this->options['form_params']['BizName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizAppCode($value)
    {
        $this->data['BizAppCode'] = $value;
        $this->options['form_params']['BizAppCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRoomId($value)
    {
        $this->data['RoomId'] = $value;
        $this->options['form_params']['RoomId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRecordId($value)
    {
        $this->data['RecordId'] = $value;
        $this->options['form_params']['RecordId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withS($value)
    {
        $this->data['S'] = $value;
        $this->options['form_params']['S'] = $value;

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
    public function withMediaType($value)
    {
        $this->data['MediaType'] = $value;
        $this->options['form_params']['MediaType'] = $value;

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
