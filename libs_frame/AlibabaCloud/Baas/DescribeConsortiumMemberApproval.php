<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getLocation()
 * @method string getConsortiumId()
 * @method $this withConsortiumId($value)
 */
class DescribeConsortiumMemberApproval extends Rpc
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
