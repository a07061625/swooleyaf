<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getApiGatewayGroupId()
 * @method string getTenantId()
 * @method string getDescription()
 * @method string getProjectId()
 * @method string getGroupName()
 */
class CreateDataServiceGroup extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiGatewayGroupId($value)
    {
        $this->data['ApiGatewayGroupId'] = $value;
        $this->options['form_params']['ApiGatewayGroupId'] = $value;

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
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

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
    public function withGroupName($value)
    {
        $this->data['GroupName'] = $value;
        $this->options['form_params']['GroupName'] = $value;

        return $this;
    }
}
