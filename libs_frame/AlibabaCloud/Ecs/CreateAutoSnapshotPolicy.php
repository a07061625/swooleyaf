<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getCopiedSnapshotsRetentionDays()
 * @method $this withCopiedSnapshotsRetentionDays($value)
 * @method string getTimePoints()
 * @method string getRepeatWeekdays()
 * @method array getTag()
 * @method string getEnableCrossRegionCopy()
 * @method $this withEnableCrossRegionCopy($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAutoSnapshotPolicyName()
 * @method string getRetentionDays()
 * @method string getTargetCopyRegions()
 * @method $this withTargetCopyRegions($value)
 */
class CreateAutoSnapshotPolicy extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTimePoints($value)
    {
        $this->data['TimePoints'] = $value;
        $this->options['query']['timePoints'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRepeatWeekdays($value)
    {
        $this->data['RepeatWeekdays'] = $value;
        $this->options['query']['repeatWeekdays'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAutoSnapshotPolicyName($value)
    {
        $this->data['AutoSnapshotPolicyName'] = $value;
        $this->options['query']['autoSnapshotPolicyName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRetentionDays($value)
    {
        $this->data['RetentionDays'] = $value;
        $this->options['query']['retentionDays'] = $value;

        return $this;
    }
}
