<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getTenantId()
 * @method string getProjectId()
 * @method string getApiId()
 */
class DeleteDataServiceApi extends Rpc
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
}
