<?php

namespace AlibabaCloud\Smartag;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getVbrInstanceIds()
 * @method string getVbrRegionId()
 * @method $this withVbrRegionId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeSagVbrRelations extends Rpc
{
    /**
     * @return $this
     */
    public function withVbrInstanceIds(array $vbrInstanceIds)
    {
        $this->data['VbrInstanceIds'] = $vbrInstanceIds;
        foreach ($vbrInstanceIds as $i => $iValue) {
            $this->options['query']['VbrInstanceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
