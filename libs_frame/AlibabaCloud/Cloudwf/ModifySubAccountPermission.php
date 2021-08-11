<?php

namespace AlibabaCloud\Cloudwf;

/**
 * @method array getShopGroupIds()
 * @method array getShopIds()
 * @method string getPagePermission()
 * @method $this withPagePermission($value)
 * @method string getId()
 * @method $this withId($value)
 * @method array getBusinessIds()
 */
class ModifySubAccountPermission extends Rpc
{
    /**
     * @return $this
     */
    public function withShopGroupIds(array $shopGroupIds)
    {
        $this->data['ShopGroupIds'] = $shopGroupIds;
        foreach ($shopGroupIds as $i => $iValue) {
            $this->options['query']['ShopGroupIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withShopIds(array $shopIds)
    {
        $this->data['ShopIds'] = $shopIds;
        foreach ($shopIds as $i => $iValue) {
            $this->options['query']['ShopIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withBusinessIds(array $businessIds)
    {
        $this->data['BusinessIds'] = $businessIds;
        foreach ($businessIds as $i => $iValue) {
            $this->options['query']['BusinessIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
