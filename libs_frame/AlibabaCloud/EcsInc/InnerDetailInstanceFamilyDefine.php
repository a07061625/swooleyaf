<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method array getInstanceTypeFamily()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class InnerDetailInstanceFamilyDefine extends Rpc
{
    /**
     * @return $this
     */
    public function withInstanceTypeFamily(array $instanceTypeFamily)
    {
        $this->data['InstanceTypeFamily'] = $instanceTypeFamily;
        foreach ($instanceTypeFamily as $i => $iValue) {
            $this->options['query']['InstanceTypeFamily.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
