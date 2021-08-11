<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getMpaasMappcenterMgsTestreqbodyautogenQueryJsonStr()
 * @method string getTenantId()
 * @method string getFormat()
 * @method string getAppId()
 * @method string getWorkspaceId()
 */
class QueryMgsTestreqbodyautogen extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMpaasMappcenterMgsTestreqbodyautogenQueryJsonStr($value)
    {
        $this->data['MpaasMappcenterMgsTestreqbodyautogenQueryJsonStr'] = $value;
        $this->options['form_params']['MpaasMappcenterMgsTestreqbodyautogenQueryJsonStr'] = $value;

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
    public function withFormat($value)
    {
        $this->data['Format'] = $value;
        $this->options['form_params']['Format'] = $value;

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
