<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getMpaasMappcenterMgsApirestSaveJsonStr()
 * @method string getTenantId()
 * @method string getAppId()
 * @method string getWorkspaceId()
 */
class SaveMgsApirest extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMpaasMappcenterMgsApirestSaveJsonStr($value)
    {
        $this->data['MpaasMappcenterMgsApirestSaveJsonStr'] = $value;
        $this->options['form_params']['MpaasMappcenterMgsApirestSaveJsonStr'] = $value;

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
