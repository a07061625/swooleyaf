<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class GetGroups extends Roa
{
    /** @var string */
    public $pathPattern = '/green/sface/groups';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientInfo($value)
    {
        $this->data['ClientInfo'] = $value;
        $this->options['query']['ClientInfo'] = $value;

        return $this;
    }
}
