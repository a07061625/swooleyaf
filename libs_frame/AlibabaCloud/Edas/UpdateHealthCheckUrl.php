<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 * @method string getHcURL()
 */
class UpdateHealthCheckUrl extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/app/modify_hc_url';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHcURL($value)
    {
        $this->data['HcURL'] = $value;
        $this->options['query']['hcURL'] = $value;

        return $this;
    }
}
