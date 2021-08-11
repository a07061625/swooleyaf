<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class GetClusterProjects extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/projects';
}
