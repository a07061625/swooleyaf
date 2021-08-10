<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getOnexFlag()
 * @method string getTenantId()
 * @method string getAppId()
 * @method string getWorkspaceId()
 */
class GetMcubeFileToken extends Rpc
{
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
