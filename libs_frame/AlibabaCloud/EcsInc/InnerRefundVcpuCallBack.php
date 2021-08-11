<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getVcpuTotal()
 * @method $this withVcpuTotal($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getAliUid()
 * @method $this withAliUid($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getIsSuccess()
 * @method $this withIsSuccess($value)
 * @method array getInstanceIds()
 */
class InnerRefundVcpuCallBack extends Rpc
{
    /**
     * @return $this
     */
    public function withInstanceIds(array $instanceIds)
    {
        $this->data['InstanceIds'] = $instanceIds;
        foreach ($instanceIds as $i => $iValue) {
            $this->options['query']['InstanceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
