<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getGroupId()
 */
class DeleteServiceGroup extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/service/serviceGroups';

    /** @var string */
    public $method = 'DELETE';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroupId($value)
    {
        $this->data['GroupId'] = $value;
        $this->options['query']['GroupId'] = $value;

        return $this;
    }
}
