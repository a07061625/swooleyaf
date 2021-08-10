<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getOrganizationId()
 * @method string getChaincodeId()
 * @method string getLocation()
 */
class InstallChaincode extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrganizationId($value)
    {
        $this->data['OrganizationId'] = $value;
        $this->options['form_params']['OrganizationId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChaincodeId($value)
    {
        $this->data['ChaincodeId'] = $value;
        $this->options['form_params']['ChaincodeId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLocation($value)
    {
        $this->data['Location'] = $value;
        $this->options['form_params']['Location'] = $value;

        return $this;
    }
}
