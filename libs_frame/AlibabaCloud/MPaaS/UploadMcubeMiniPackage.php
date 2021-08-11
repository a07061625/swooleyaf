<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getAutoInstall()
 * @method string getInstallType()
 * @method string getOnexFlag()
 * @method string getEnableOptionMenu()
 * @method string getH5Version()
 * @method string getEnableTabBar()
 * @method string getUserId()
 * @method string getUuid()
 * @method string getResourceFileUrl()
 * @method string getH5Id()
 * @method string getExtendInfo()
 * @method string getMainUrl()
 * @method string getClientVersionMin()
 * @method string getEnableKeepAlive()
 * @method string getVhost()
 * @method string getClientVersionMax()
 * @method string getPackageType()
 * @method string getWorkspaceId()
 * @method string getH5Name()
 * @method string getPlatform()
 * @method string getTenantId()
 * @method string getResourceType()
 * @method string getIconFileUrl()
 * @method string getAppId()
 */
class UploadMcubeMiniPackage extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAutoInstall($value)
    {
        $this->data['AutoInstall'] = $value;
        $this->options['form_params']['AutoInstall'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstallType($value)
    {
        $this->data['InstallType'] = $value;
        $this->options['form_params']['InstallType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOnexFlag($value)
    {
        $this->data['OnexFlag'] = $value;
        $this->options['form_params']['OnexFlag'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnableOptionMenu($value)
    {
        $this->data['EnableOptionMenu'] = $value;
        $this->options['form_params']['EnableOptionMenu'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withH5Version($value)
    {
        $this->data['H5Version'] = $value;
        $this->options['form_params']['H5Version'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnableTabBar($value)
    {
        $this->data['EnableTabBar'] = $value;
        $this->options['form_params']['EnableTabBar'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserId($value)
    {
        $this->data['UserId'] = $value;
        $this->options['form_params']['UserId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUuid($value)
    {
        $this->data['Uuid'] = $value;
        $this->options['form_params']['Uuid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResourceFileUrl($value)
    {
        $this->data['ResourceFileUrl'] = $value;
        $this->options['form_params']['ResourceFileUrl'] = $value;

        return $this;
    }

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
    public function withExtendInfo($value)
    {
        $this->data['ExtendInfo'] = $value;
        $this->options['form_params']['ExtendInfo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMainUrl($value)
    {
        $this->data['MainUrl'] = $value;
        $this->options['form_params']['MainUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientVersionMin($value)
    {
        $this->data['ClientVersionMin'] = $value;
        $this->options['form_params']['ClientVersionMin'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnableKeepAlive($value)
    {
        $this->data['EnableKeepAlive'] = $value;
        $this->options['form_params']['EnableKeepAlive'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVhost($value)
    {
        $this->data['Vhost'] = $value;
        $this->options['form_params']['Vhost'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientVersionMax($value)
    {
        $this->data['ClientVersionMax'] = $value;
        $this->options['form_params']['ClientVersionMax'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPackageType($value)
    {
        $this->data['PackageType'] = $value;
        $this->options['form_params']['PackageType'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withH5Name($value)
    {
        $this->data['H5Name'] = $value;
        $this->options['form_params']['H5Name'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPlatform($value)
    {
        $this->data['Platform'] = $value;
        $this->options['form_params']['Platform'] = $value;

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
    public function withResourceType($value)
    {
        $this->data['ResourceType'] = $value;
        $this->options['form_params']['ResourceType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIconFileUrl($value)
    {
        $this->data['IconFileUrl'] = $value;
        $this->options['form_params']['IconFileUrl'] = $value;

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
}
