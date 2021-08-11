<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getJobId()
 * @method $this withJobId($value)
 * @method string getTaskStatus()
 * @method $this withTaskStatus($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getDeviceNames()
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class ListOTATaskByJob extends Rpc
{
    /**
     * @return $this
     */
    public function withDeviceNames(array $deviceNames)
    {
        $this->data['DeviceNames'] = $deviceNames;
        foreach ($deviceNames as $i => $iValue) {
            $this->options['query']['DeviceNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
