<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getConsortiumId()
 */
class DescribeInvitationCode extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConsortiumId($value)
    {
        $this->data['ConsortiumId'] = $value;
        $this->options['form_params']['ConsortiumId'] = $value;

        return $this;
    }
}
