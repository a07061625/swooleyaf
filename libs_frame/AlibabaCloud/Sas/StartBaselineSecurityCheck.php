<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getItemIds()
 * @method string getType()
 * @method $this withType($value)
 * @method array getAssets()
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getLang()
 * @method $this withLang($value)
 */
class StartBaselineSecurityCheck extends Rpc
{
    /**
     * @return $this
     */
    public function withItemIds(array $itemIds)
    {
        $this->data['ItemIds'] = $itemIds;
        foreach ($itemIds as $i => $iValue) {
            $this->options['query']['ItemIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withAssets(array $assets)
    {
        $this->data['Assets'] = $assets;
        foreach ($assets as $i => $iValue) {
            $this->options['query']['Assets.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
