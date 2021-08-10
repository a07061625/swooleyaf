<?php

namespace AlibabaCloud\EmasAppmonitor;

/**
 * @method string getUniqueAppId()
 */
class GetSdkConfig extends Rpc
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
}
