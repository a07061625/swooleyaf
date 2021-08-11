<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getOrganizationId()
 */
class DescribeChaincodeUploadPolicy extends Rpc
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
}
