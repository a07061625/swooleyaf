<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getPackageId()
 * @method string getMemo()
 * @method string getGreyConfigInfo()
 * @method string getTenantId()
 * @method string getPublishMode()
 * @method string getWhitelistIds()
 * @method string getPublishType()
 * @method string getGreyNum()
 * @method string getAppId()
 * @method string getGreyEndtimeData()
 * @method string getWorkspaceId()
 */
class CreateMcubeMiniTask extends Rpc
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
    public function withMemo($value)
    {
        $this->data['Memo'] = $value;
        $this->options['form_params']['Memo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGreyConfigInfo($value)
    {
        $this->data['GreyConfigInfo'] = $value;
        $this->options['form_params']['GreyConfigInfo'] = $value;

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
    public function withPublishMode($value)
    {
        $this->data['PublishMode'] = $value;
        $this->options['form_params']['PublishMode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWhitelistIds($value)
    {
        $this->data['WhitelistIds'] = $value;
        $this->options['form_params']['WhitelistIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPublishType($value)
    {
        $this->data['PublishType'] = $value;
        $this->options['form_params']['PublishType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGreyNum($value)
    {
        $this->data['GreyNum'] = $value;
        $this->options['form_params']['GreyNum'] = $value;

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
    public function withGreyEndtimeData($value)
    {
        $this->data['GreyEndtimeData'] = $value;
        $this->options['form_params']['GreyEndtimeData'] = $value;

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
