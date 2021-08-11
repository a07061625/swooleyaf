<?php

namespace AlibabaCloud\Schedulerx2;

/**
 * @method string getNamespaceSource()
 * @method $this withNamespaceSource($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getNamespace()
 * @method $this withNamespace($value)
 * @method string getUserId()
 * @method $this withUserId($value)
 */
class RevokePermission extends Rpc
{
    /** @var string */
    public $method = 'POST';
}
