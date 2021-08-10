<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getMainUserId()
 * @method string getSilenceTime()
 * @method array getMonitorIds()
 * @method string getTemplateId()
 */
class UpdateAppMonitors extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMainUserId($value)
    {
        $this->data['MainUserId'] = $value;
        $this->options['form_params']['MainUserId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSilenceTime($value)
    {
        $this->data['SilenceTime'] = $value;
        $this->options['form_params']['SilenceTime'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withMonitorIds(array $monitorIds)
    {
        $this->data['MonitorIds'] = $monitorIds;
        foreach ($monitorIds as $i => $iValue) {
            $this->options['form_params']['MonitorIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTemplateId($value)
    {
        $this->data['TemplateId'] = $value;
        $this->options['form_params']['TemplateId'] = $value;

        return $this;
    }
}
