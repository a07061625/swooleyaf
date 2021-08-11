<?php

namespace AlibabaCloud\Smartag;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getNetworkOptId()
 * @method $this withNetworkOptId($value)
 * @method array getSmartAGIds()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DetachNetworkOptimizationSags extends Rpc
{
    /**
     * @return $this
     */
    public function withSmartAGIds(array $smartAGIds)
    {
        $this->data['SmartAGIds'] = $smartAGIds;
        foreach ($smartAGIds as $i => $iValue) {
            $this->options['query']['SmartAGIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
