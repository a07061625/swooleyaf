<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getNeedEtag()
 * @method string getApiType()
 * @method string getOptFuzzy()
 * @method string getHost()
 * @method string getPageSize()
 * @method string getTenantId()
 * @method string getPageIndex()
 * @method string getApiStatus()
 * @method string getSysId()
 * @method string getFormat()
 * @method string getNeedEncrypt()
 * @method string getOperationType()
 * @method string getNeedSign()
 * @method string getAppId()
 * @method string getSysName()
 * @method string getWorkspaceId()
 */
class QueryMgsApipage extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNeedEtag($value)
    {
        $this->data['NeedEtag'] = $value;
        $this->options['form_params']['NeedEtag'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiType($value)
    {
        $this->data['ApiType'] = $value;
        $this->options['form_params']['ApiType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOptFuzzy($value)
    {
        $this->data['OptFuzzy'] = $value;
        $this->options['form_params']['OptFuzzy'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHost($value)
    {
        $this->data['Host'] = $value;
        $this->options['form_params']['Host'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

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
    public function withPageIndex($value)
    {
        $this->data['PageIndex'] = $value;
        $this->options['form_params']['PageIndex'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiStatus($value)
    {
        $this->data['ApiStatus'] = $value;
        $this->options['form_params']['ApiStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSysId($value)
    {
        $this->data['SysId'] = $value;
        $this->options['form_params']['SysId'] = $value;

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
    public function withNeedEncrypt($value)
    {
        $this->data['NeedEncrypt'] = $value;
        $this->options['form_params']['NeedEncrypt'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOperationType($value)
    {
        $this->data['OperationType'] = $value;
        $this->options['form_params']['OperationType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNeedSign($value)
    {
        $this->data['NeedSign'] = $value;
        $this->options['form_params']['NeedSign'] = $value;

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
    public function withSysName($value)
    {
        $this->data['SysName'] = $value;
        $this->options['form_params']['SysName'] = $value;

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
