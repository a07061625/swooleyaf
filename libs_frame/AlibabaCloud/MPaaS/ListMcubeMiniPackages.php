<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getH5Id()
 * @method string getTenantId()
 * @method string getAppId()
 * @method string getPackageTypes()
 * @method string getWorkspaceId()
 */
class ListMcubeMiniPackages extends Rpc
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
    public function withPackageTypes($value)
    {
        $this->data['PackageTypes'] = $value;
        $this->options['form_params']['PackageTypes'] = $value;

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
