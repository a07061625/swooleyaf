<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getId()
 * @method array getInvitee()
 */
class ApproveEthereumInvitee extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withId($value)
    {
        $this->data['Id'] = $value;
        $this->options['form_params']['Id'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withInvitee(array $invitee)
    {
        $this->data['Invitee'] = $invitee;
        foreach ($invitee as $depth1 => $depth1Value) {
            $this->options['form_params']['Invitee.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
        }

        return $this;
    }
}
