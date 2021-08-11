<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class AttachInstances extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/attach';

    /** @var string */
    public $method = 'POST';
}
