<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getDisk()
 */
class ResetDisks extends Rpc
{
    /**
     * @return $this
     */
    public function withDisk(array $disk)
    {
        $this->data['Disk'] = $disk;
        foreach ($disk as $depth1 => $depth1Value) {
            if (isset($depth1Value['SnapshotId'])) {
                $this->options['query']['Disk.' . ($depth1 + 1) . '.SnapshotId'] = $depth1Value['SnapshotId'];
            }
            if (isset($depth1Value['DiskId'])) {
                $this->options['query']['Disk.' . ($depth1 + 1) . '.DiskId'] = $depth1Value['DiskId'];
            }
        }

        return $this;
    }
}
