<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getLifecycleHookName()
 * @method $this withLifecycleHookName($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method array getLifecycleHookId()
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeLifecycleHooks extends Rpc
{
    /**
     * @return $this
     */
    public function withLifecycleHookId(array $lifecycleHookId)
    {
        $this->data['LifecycleHookId'] = $lifecycleHookId;
        foreach ($lifecycleHookId as $i => $iValue) {
            $this->options['query']['LifecycleHookId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
