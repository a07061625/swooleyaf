<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getMpaasMappcenterMsaEnhanceCreateJsonStr()
 * @method string getTenantId()
 * @method string getAppId()
 * @method string getWorkspaceId()
 */
class CreateMsaEnhance extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMpaasMappcenterMsaEnhanceCreateJsonStr($value)
    {
        $this->data['MpaasMappcenterMsaEnhanceCreateJsonStr'] = $value;
        $this->options['form_params']['MpaasMappcenterMsaEnhanceCreateJsonStr'] = $value;

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
