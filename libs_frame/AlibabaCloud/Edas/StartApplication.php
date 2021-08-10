<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 * @method string getEccInfo()
 */
class StartApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/changeorder/co_start';

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
    public function withEccInfo($value)
    {
        $this->data['EccInfo'] = $value;
        $this->options['query']['EccInfo'] = $value;

        return $this;
    }
}
