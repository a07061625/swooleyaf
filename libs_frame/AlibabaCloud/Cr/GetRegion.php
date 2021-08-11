<?php

namespace AlibabaCloud\Cr;

/**
 * @method string getDomain()
 */
class GetRegion extends Roa
{
    /** @var string */
    public $pathPattern = '/regions';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDomain($value)
    {
        $this->data['Domain'] = $value;
        $this->options['query']['Domain'] = $value;

        return $this;
    }
}
