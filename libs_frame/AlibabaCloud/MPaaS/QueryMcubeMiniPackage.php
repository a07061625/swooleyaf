<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getH5Id()
 * @method string getTenantId()
 * @method string getId()
 * @method string getAppId()
 * @method string getWorkspaceId()
 */
class QueryMcubeMiniPackage extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withH5Id($value)
    {
        $this->data['H5Id'] = $value;
        $this->options['form_params']['H5Id'] = $value;

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
    public function withId($value)
    {
        $this->data['Id'] = $value;
        $this->options['form_params']['Id'] = $value;

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
