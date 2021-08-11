<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class ScaleInCluster extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/scalein';

    /** @var string */
    public $method = 'POST';
}
