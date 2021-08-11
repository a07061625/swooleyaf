<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getResourceId()
 * @method $this withResourceId($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getResourceStatusList()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method array getResourceTypeList()
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getFromRegionNo()
 * @method $this withFromRegionNo($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceTransitId()
 * @method $this withResourceTransitId($value)
 * @method string getPageNo()
 * @method $this withPageNo($value)
 * @method string getDbId()
 * @method $this withDbId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getAliUid()
 * @method $this withAliUid($value)
 * @method string getResourceName()
 * @method $this withResourceName($value)
 * @method array getTag()
 */
class QueryResourceTransit extends Rpc
{
    /**
     * @return $this
     */
    public function withResourceStatusList(array $resourceStatusList)
    {
        $this->data['ResourceStatusList'] = $resourceStatusList;
        foreach ($resourceStatusList as $i => $iValue) {
            $this->options['query']['ResourceStatusList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withResourceTypeList(array $resourceTypeList)
    {
        $this->data['ResourceTypeList'] = $resourceTypeList;
        foreach ($resourceTypeList as $i => $iValue) {
            $this->options['query']['ResourceTypeList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
        }

        return $this;
    }
}
