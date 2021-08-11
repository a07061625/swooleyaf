<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getPrefixListId()
 * @method $this withPrefixListId($value)
 * @method array getAddEntry()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getPrefixListName()
 * @method $this withPrefixListName($value)
 * @method array getRemoveEntry()
 */
class ModifyPrefixList extends Rpc
{
    /**
     * @return $this
     */
    public function withAddEntry(array $addEntry)
    {
        $this->data['AddEntry'] = $addEntry;
        foreach ($addEntry as $depth1 => $depth1Value) {
            if (isset($depth1Value['Cidr'])) {
                $this->options['query']['AddEntry.' . ($depth1 + 1) . '.Cidr'] = $depth1Value['Cidr'];
            }
            if (isset($depth1Value['Description'])) {
                $this->options['query']['AddEntry.' . ($depth1 + 1) . '.Description'] = $depth1Value['Description'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withRemoveEntry(array $removeEntry)
    {
        $this->data['RemoveEntry'] = $removeEntry;
        foreach ($removeEntry as $depth1 => $depth1Value) {
            if (isset($depth1Value['Cidr'])) {
                $this->options['query']['RemoveEntry.' . ($depth1 + 1) . '.Cidr'] = $depth1Value['Cidr'];
            }
        }

        return $this;
    }
}
