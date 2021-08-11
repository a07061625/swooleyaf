<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getCode()
 * @method $this withCode($value)
 * @method array getOrganization()
 * @method string getConsortiumId()
 * @method $this withConsortiumId($value)
 */
class CreateConsortiumMember extends Rpc
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
