<?php

namespace AlibabaCloud\CS;

/**
 * @method string getServiceId()
 */
class DescribeUserContainers extends Roa
{
    /** @var string */
    public $pathPattern = '/region/[RegionId]/containers';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceId($value)
    {
        $this->data['ServiceId'] = $value;
        $this->options['query']['ServiceId'] = $value;

        return $this;
    }
}
