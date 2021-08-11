<?php

namespace AlibabaCloud\CS;

/**
 * @method string getComponentId()
 * @method $this withComponentId($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class UpgradeClusterComponents extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/components/[ComponentId]/upgrade';

    /** @var string */
    public $method = 'POST';
}
