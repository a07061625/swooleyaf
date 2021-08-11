<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getTenantId()
 * @method string getWhitelistType()
 * @method string getAppId()
 * @method string getWhiteListName()
 * @method string getWorkspaceId()
 */
class CreateMcubeWhitelist extends Rpc
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
    public function withWhitelistType($value)
    {
        $this->data['WhitelistType'] = $value;
        $this->options['form_params']['WhitelistType'] = $value;

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
    public function withWhiteListName($value)
    {
        $this->data['WhiteListName'] = $value;
        $this->options['form_params']['WhiteListName'] = $value;

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
