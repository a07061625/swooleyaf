<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getOrganizationId()
 * @method $this withOrganizationId($value)
 * @method string getLocation()
 * @method string getUsername()
 * @method $this withUsername($value)
 */
class DownloadOrganizationSDK extends Rpc
{
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
