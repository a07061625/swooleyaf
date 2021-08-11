<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getDebugEnable()
 */
class ListUserDefineRegion extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/user_region_defs';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDebugEnable($value)
    {
        $this->data['DebugEnable'] = $value;
        $this->options['query']['DebugEnable'] = $value;

        return $this;
    }
}
