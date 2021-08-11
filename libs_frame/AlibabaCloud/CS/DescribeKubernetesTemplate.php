<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class DescribeKubernetesTemplate extends Roa
{
    /** @var string */
    public $pathPattern = '/k8s/templates/[ClusterId]';
}
