<?php

namespace AlibabaCloud\EmasAppmonitor;

/**
 * @method string getUniqueAppId()
 * @method string getFromDateMs()
 * @method string getService()
 * @method string getUntilDateMs()
 */
class GetAppDailyDeviceCount extends Rpc
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
    public function withFromDateMs($value)
    {
        $this->data['FromDateMs'] = $value;
        $this->options['form_params']['FromDateMs'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withService($value)
    {
        $this->data['Service'] = $value;
        $this->options['form_params']['Service'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUntilDateMs($value)
    {
        $this->data['UntilDateMs'] = $value;
        $this->options['form_params']['UntilDateMs'] = $value;

        return $this;
    }
}
