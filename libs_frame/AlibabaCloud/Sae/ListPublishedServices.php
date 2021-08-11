<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getAppId()
 */
class ListPublishedServices extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/service/listPublishedServices';

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
