<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getInstanceId()
 */
class DescribeInstanceLog extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/instance/describeInstanceLog';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->options['query']['InstanceId'] = $value;

        return $this;
    }
}
