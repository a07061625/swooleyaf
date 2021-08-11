<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 */
class ListConsumedServices extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/service/listConsumedServices';

    /** @var string */
    public $method = 'GET';

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
