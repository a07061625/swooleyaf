<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class DeleteFaces extends Roa
{
    /** @var string */
    public $pathPattern = '/green/sface/face/delete';

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
