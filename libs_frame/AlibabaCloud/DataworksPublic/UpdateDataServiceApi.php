<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getScriptDetails()
 * @method string getRequestMethod()
 * @method string getApiPath()
 * @method string getWizardDetails()
 * @method string getVisibleRange()
 * @method string getApiDescription()
 * @method string getTimeout()
 * @method string getRegistrationDetails()
 * @method string getTenantId()
 * @method string getProtocols()
 * @method string getProjectId()
 * @method string getApiId()
 * @method string getResponseContentType()
 */
class UpdateDataServiceApi extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScriptDetails($value)
    {
        $this->data['ScriptDetails'] = $value;
        $this->options['form_params']['ScriptDetails'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRequestMethod($value)
    {
        $this->data['RequestMethod'] = $value;
        $this->options['form_params']['RequestMethod'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiPath($value)
    {
        $this->data['ApiPath'] = $value;
        $this->options['form_params']['ApiPath'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWizardDetails($value)
    {
        $this->data['WizardDetails'] = $value;
        $this->options['form_params']['WizardDetails'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVisibleRange($value)
    {
        $this->data['VisibleRange'] = $value;
        $this->options['form_params']['VisibleRange'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiDescription($value)
    {
        $this->data['ApiDescription'] = $value;
        $this->options['form_params']['ApiDescription'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTimeout($value)
    {
        $this->data['Timeout'] = $value;
        $this->options['form_params']['Timeout'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRegistrationDetails($value)
    {
        $this->data['RegistrationDetails'] = $value;
        $this->options['form_params']['RegistrationDetails'] = $value;

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
    public function withProtocols($value)
    {
        $this->data['Protocols'] = $value;
        $this->options['form_params']['Protocols'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiId($value)
    {
        $this->data['ApiId'] = $value;
        $this->options['form_params']['ApiId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResponseContentType($value)
    {
        $this->data['ResponseContentType'] = $value;
        $this->options['form_params']['ResponseContentType'] = $value;

        return $this;
    }
}
