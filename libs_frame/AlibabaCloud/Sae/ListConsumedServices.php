<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getAppId()
 */
class ListConsumedServices extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/service/listConsumedServices';

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
