<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getType()
 */
class SynchronizeResource extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/pop_sync_resource';

    /** @var string */
    public $method = 'GET';

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
