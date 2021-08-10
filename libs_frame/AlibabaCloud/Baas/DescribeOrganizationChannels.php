<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getOrganizationId()
 * @method $this withOrganizationId($value)
 * @method string getLocation()
 */
class DescribeOrganizationChannels extends Rpc
{
    /** @var string */
    public $method = 'PUT';

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
