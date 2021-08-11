<?php

namespace AlibabaCloud\Live;

/**
 * @method string getCasterId()
 * @method $this withCasterId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getSyncGroup()
 */
class SetCasterSyncGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withSyncGroup(array $syncGroup)
    {
        $this->data['SyncGroup'] = $syncGroup;
        foreach ($syncGroup as $depth1 => $depth1Value) {
            if (isset($depth1Value['Mode'])) {
                $this->options['query']['SyncGroup.' . ($depth1 + 1) . '.Mode'] = $depth1Value['Mode'];
            }
            if (isset($depth1Value['SyncDelayThreshold'])) {
                $this->options['query']['SyncGroup.' . ($depth1 + 1) . '.SyncDelayThreshold'] = $depth1Value['SyncDelayThreshold'];
            }
            if (isset($depth1Value['HostResourceId'])) {
                $this->options['query']['SyncGroup.' . ($depth1 + 1) . '.HostResourceId'] = $depth1Value['HostResourceId'];
            }
            foreach ($depth1Value['ResourceIds'] as $i => $iValue) {
                $this->options['query']['SyncGroup.' . ($depth1 + 1) . '.ResourceIds.' . ($i + 1)] = $iValue;
            }
        }

        return $this;
    }
}
