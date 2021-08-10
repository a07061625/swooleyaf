<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getMaxEntries()
 * @method $this withMaxEntries($value)
 * @method string getAddressFamily()
 * @method $this withAddressFamily($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getPrefixListName()
 * @method $this withPrefixListName($value)
 * @method array getEntry()
 */
class CreatePrefixList extends Rpc
{
    /**
     * @return $this
     */
    public function withEntry(array $entry)
    {
        $this->data['Entry'] = $entry;
        foreach ($entry as $depth1 => $depth1Value) {
            if (isset($depth1Value['Cidr'])) {
                $this->options['query']['Entry.' . ($depth1 + 1) . '.Cidr'] = $depth1Value['Cidr'];
            }
            if (isset($depth1Value['Description'])) {
                $this->options['query']['Entry.' . ($depth1 + 1) . '.Description'] = $depth1Value['Description'];
            }
        }

        return $this;
    }
}
