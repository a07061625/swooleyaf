<?php

namespace AlibabaCloud\Cr;

/**
 * @method string getNamespace()
 * @method $this withNamespace($value)
 */
class UpdateNamespace extends Roa
{
    /** @var string */
    public $pathPattern = '/namespace/[Namespace]';

    /** @var string */
    public $method = 'POST';
}
