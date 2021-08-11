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
 * @method string getRegionNo()
 * @method $this withRegionNo($value)
 */
class UnbindInstance2Vpc extends Rpc
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
