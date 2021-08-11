<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 */
class ListDegradeControls extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/app/degradeControls';

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
