<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method array getDevEuiList()
 */
class DeleteExternalNodeTuples extends Rpc
{
    /**
     * @return $this
     */
    public function withDevEuiList(array $devEuiList)
    {
        $this->data['DevEuiList'] = $devEuiList;
        foreach ($devEuiList as $i => $iValue) {
            $this->options['form_params']['DevEuiList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
