<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getAppId()
 * @method string getType()
 */
class DescribeComponents extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/resource/components';

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
    public function withType($value)
    {
        $this->data['Type'] = $value;
        $this->options['query']['Type'] = $value;

        return $this;
    }
}
