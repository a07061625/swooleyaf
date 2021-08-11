<?php

namespace AlibabaCloud\Openanalytics;

/**
 * @method string getTargetUid()
 */
class GetRegionStatus extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetUid($value)
    {
        $this->data['TargetUid'] = $value;
        $this->options['form_params']['TargetUid'] = $value;

        return $this;
    }
}
