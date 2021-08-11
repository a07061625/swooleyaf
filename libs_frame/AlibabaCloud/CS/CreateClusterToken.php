<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class CreateClusterToken extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/token';

    /** @var string */
    public $method = 'POST';
}
