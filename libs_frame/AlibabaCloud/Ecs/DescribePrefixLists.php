<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getPrefixListId()
 * @method string getNextToken()
 * @method $this withNextToken($value)
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
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class DescribePrefixLists extends Rpc
{
    /**
     * @return $this
     */
    public function withPrefixListId(array $prefixListId)
    {
        $this->data['PrefixListId'] = $prefixListId;
        foreach ($prefixListId as $i => $iValue) {
            $this->options['query']['PrefixListId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
