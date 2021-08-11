<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 */
class GetApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/app/app_info';

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
}
