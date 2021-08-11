<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getApiNameKeyword()
 * @method string getApiPathKeyword()
 * @method string getCreatorId()
 * @method string getPageNumber()
 * @method string getPageSize()
 * @method string getTenantId()
 * @method string getProjectId()
 */
class ListDataServicePublishedApis extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiNameKeyword($value)
    {
        $this->data['ApiNameKeyword'] = $value;
        $this->options['form_params']['ApiNameKeyword'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiPathKeyword($value)
    {
        $this->data['ApiPathKeyword'] = $value;
        $this->options['form_params']['ApiPathKeyword'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCreatorId($value)
    {
        $this->data['CreatorId'] = $value;
        $this->options['form_params']['CreatorId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

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
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }
}
