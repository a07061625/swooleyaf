<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getAppId()
 */
class StartApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/app/startApplication';

    /** @var string */
    public $method = 'PUT';

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
