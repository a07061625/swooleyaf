<?php

namespace AlibabaCloud\Smartag;

/**
 * @method array getDpiGroupIds()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getDpiGroupNames()
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class ListDpiGroups extends Rpc
{
    /**
     * @return $this
     */
    public function withDpiGroupIds(array $dpiGroupIds)
    {
        $this->data['DpiGroupIds'] = $dpiGroupIds;
        foreach ($dpiGroupIds as $i => $iValue) {
            $this->options['query']['DpiGroupIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDpiGroupNames(array $dpiGroupNames)
    {
        $this->data['DpiGroupNames'] = $dpiGroupNames;
        foreach ($dpiGroupNames as $i => $iValue) {
            $this->options['query']['DpiGroupNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
