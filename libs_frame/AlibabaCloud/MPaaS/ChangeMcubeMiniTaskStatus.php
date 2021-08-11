<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getPackageId()
 * @method string getTaskStatus()
 * @method string getTenantId()
 * @method string getTaskId()
 * @method string getBizType()
 * @method string getAppId()
 * @method string getWorkspaceId()
 */
class ChangeMcubeMiniTaskStatus extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPackageId($value)
    {
        $this->data['PackageId'] = $value;
        $this->options['form_params']['PackageId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskStatus($value)
    {
        $this->data['TaskStatus'] = $value;
        $this->options['form_params']['TaskStatus'] = $value;

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
    public function withTaskId($value)
    {
        $this->data['TaskId'] = $value;
        $this->options['form_params']['TaskId'] = $value;

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
