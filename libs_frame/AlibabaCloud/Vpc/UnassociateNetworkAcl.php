<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getNetworkAclId()
 * @method $this withNetworkAclId($value)
 * @method array getResource()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class UnassociateNetworkAcl extends Rpc
{
    /**
     * @return $this
     */
    public function withResource(array $resource)
    {
        $this->data['Resource'] = $resource;
        foreach ($resource as $depth1 => $depth1Value) {
            if (isset($depth1Value['ResourceType'])) {
                $this->options['query']['Resource.' . ($depth1 + 1) . '.ResourceType'] = $depth1Value['ResourceType'];
            }
            if (isset($depth1Value['ResourceId'])) {
                $this->options['query']['Resource.' . ($depth1 + 1) . '.ResourceId'] = $depth1Value['ResourceId'];
            }
        }

        return $this;
    }
}
