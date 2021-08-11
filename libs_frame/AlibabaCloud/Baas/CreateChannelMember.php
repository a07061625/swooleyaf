<?php

namespace AlibabaCloud\Baas;

/**
 * @method array getOrganization()
 * @method string getChannelId()
 * @method $this withChannelId($value)
 */
class CreateChannelMember extends Rpc
{
    /**
     * @return $this
     */
    public function withOrganization(array $organization)
    {
        $this->data['Organization'] = $organization;
        foreach ($organization as $depth1 => $depth1Value) {
            $this->options['query']['Organization.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
        }

        return $this;
    }
}
