<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getApiNameKeyword()
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getTenantId()
 * @method string getProjectId()
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 */
class ListDataServiceApiAuthorities extends Rpc
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
