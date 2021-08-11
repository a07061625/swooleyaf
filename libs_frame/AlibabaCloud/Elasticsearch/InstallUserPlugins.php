<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class InstallUserPlugins extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/plugins/user/actions/install';
}
