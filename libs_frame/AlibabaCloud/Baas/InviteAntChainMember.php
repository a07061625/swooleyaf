<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getInviteBid()
 * @method string getInviteUserId()
 * @method string getConsortiumId()
 */
class InviteAntChainMember extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInviteBid($value)
    {
        $this->data['InviteBid'] = $value;
        $this->options['form_params']['InviteBid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInviteUserId($value)
    {
        $this->data['InviteUserId'] = $value;
        $this->options['form_params']['InviteUserId'] = $value;

        return $this;
    }

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
