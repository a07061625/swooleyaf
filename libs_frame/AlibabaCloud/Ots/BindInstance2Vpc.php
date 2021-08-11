<?php

namespace AlibabaCloud\Ots;

/**
 * @method string getAccessKeyId()
 * @method string getInstanceVpcName()
 * @method $this withInstanceVpcName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getInstanceName()
 * @method $this withInstanceName($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getVirtualSwitchId()
 * @method $this withVirtualSwitchId($value)
 * @method string getRegionNo()
 * @method $this withRegionNo($value)
 * @method string getNetwork()
 * @method $this withNetwork($value)
 */
class BindInstance2Vpc extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessKeyId($value)
    {
        $this->data['AccessKeyId'] = $value;
        $this->options['query']['access_key_id'] = $value;

        return $this;
    }
}
