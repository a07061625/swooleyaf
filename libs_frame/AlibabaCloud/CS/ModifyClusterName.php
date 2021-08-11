<?php

namespace AlibabaCloud\CS;

class ModifyClusterName extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/name/[ClusterName]';

    /** @var string */
    public $method = 'POST';
}
