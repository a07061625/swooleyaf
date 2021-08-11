<?php

namespace AlibabaCloud\EmasAppmonitor;

/**
 * @method string getUniqueAppId()
 * @method string getDateTimeMs()
 * @method string getAppVersion()
 */
class GetCrashSummary extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUniqueAppId($value)
    {
        $this->data['UniqueAppId'] = $value;
        $this->options['form_params']['UniqueAppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDateTimeMs($value)
    {
        $this->data['DateTimeMs'] = $value;
        $this->options['form_params']['DateTimeMs'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppVersion($value)
    {
        $this->data['AppVersion'] = $value;
        $this->options['form_params']['AppVersion'] = $value;

        return $this;
    }
}
