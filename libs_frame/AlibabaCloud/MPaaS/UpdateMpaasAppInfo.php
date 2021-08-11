<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getSystemType()
 * @method string getOnexFlag()
 * @method string getAppName()
 * @method string getTenantId()
 * @method string getIdentifier()
 * @method string getIconFileUrl()
 * @method string getAppId()
 */
class UpdateMpaasAppInfo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSystemType($value)
    {
        $this->data['SystemType'] = $value;
        $this->options['form_params']['SystemType'] = $value;

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
    public function withAppName($value)
    {
        $this->data['AppName'] = $value;
        $this->options['form_params']['AppName'] = $value;

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
    public function withIdentifier($value)
    {
        $this->data['Identifier'] = $value;
        $this->options['form_params']['Identifier'] = $value;

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
