<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getAppId()
 * @method string getImageUrl()
 */
class DescribeApplicationImage extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/container/describeApplicationImage';

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
    public function withImageUrl($value)
    {
        $this->data['ImageUrl'] = $value;
        $this->options['query']['ImageUrl'] = $value;

        return $this;
    }
}
