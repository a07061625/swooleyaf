<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method array getEcsInstanceIdList()
 * @method string getClusterInstanceId()
 * @method $this withClusterInstanceId($value)
 */
class AddClusterNode extends Rpc
{
    /**
     * @return $this
     */
    public function withEcsInstanceIdList(array $ecsInstanceIdList)
    {
        $this->data['EcsInstanceIdList'] = $ecsInstanceIdList;
        foreach ($ecsInstanceIdList as $i => $iValue) {
            $this->options['query']['EcsInstanceIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
