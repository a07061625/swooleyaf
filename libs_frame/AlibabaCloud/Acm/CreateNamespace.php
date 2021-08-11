<?php

namespace AlibabaCloud\Acm;

/**
 * @method string getName()
 */
class CreateNamespace extends Roa
{
    /** @var string */
    public $pathPattern = '/diamond-ops/pop/namespace';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

        return $this;
    }
}
