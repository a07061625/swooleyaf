<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getGroupName()
 */
class InsertServiceGroup extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/service/serviceGroups';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroupName($value)
    {
        $this->data['GroupName'] = $value;
        $this->options['query']['GroupName'] = $value;

        return $this;
    }
}
