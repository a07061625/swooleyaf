<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getAppId()
 */
class DescribeApplicationStatus extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/app/describeApplicationStatus';

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
