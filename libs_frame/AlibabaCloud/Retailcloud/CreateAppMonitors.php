<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method array getAppIds()
 * @method string getMainUserId()
 * @method $this withMainUserId($value)
 * @method string getEnvType()
 * @method $this withEnvType($value)
 * @method string getAlarmTemplateId()
 * @method $this withAlarmTemplateId($value)
 * @method string getSilenceTime()
 * @method $this withSilenceTime($value)
 */
class CreateAppMonitors extends Rpc
{
    /**
     * @return $this
     */
    public function withAppIds(array $appIds)
    {
        $this->data['AppIds'] = $appIds;
        foreach ($appIds as $i => $iValue) {
            $this->options['form_params']['AppIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
