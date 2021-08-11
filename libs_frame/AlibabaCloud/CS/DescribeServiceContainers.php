<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getServiceId()
 * @method $this withServiceId($value)
 */
class DescribeServiceContainers extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/services/[ServiceId]/containers';
}
