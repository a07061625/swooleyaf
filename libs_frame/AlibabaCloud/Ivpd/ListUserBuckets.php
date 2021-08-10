<?php

namespace AlibabaCloud\Ivpd;

/**
 * @method array getData()
 */
class ListUserBuckets extends Rpc
{
    /**
     * @return $this
     */
    public function withData(array $data)
    {
        $this->data['Data'] = $data;
        foreach ($data as $depth1 => $depth1Value) {
            if (isset($depth1Value['RegionId'])) {
                $this->options['form_params']['Data.' . ($depth1 + 1) . '.RegionId'] = $depth1Value['RegionId'];
            }
        }

        return $this;
    }
}
