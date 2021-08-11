<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getSystemType()
 * @method string getOnexFlag()
 * @method string getIdentifier()
 * @method string getCertRsaBase64()
 * @method string getAppId()
 * @method string getWorkspaceId()
 */
class ExportMappCenterAppConfig extends Rpc
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
    public function withCertRsaBase64($value)
    {
        $this->data['CertRsaBase64'] = $value;
        $this->options['form_params']['CertRsaBase64'] = $value;

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
