<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getLocation()
 * @method string getConsortiumId()
 * @method $this withConsortiumId($value)
 */
class DescribeConsortiumDeletable extends Rpc
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
