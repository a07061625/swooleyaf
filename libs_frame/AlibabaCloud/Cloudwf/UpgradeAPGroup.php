<?php

namespace AlibabaCloud\Cloudwf;

/**
 * @method array getIds()
 */
class UpgradeAPGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withIds(array $ids)
    {
        $this->data['Ids'] = $ids;
        foreach ($ids as $i => $iValue) {
            $this->options['query']['Ids.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
