<?php

namespace AlibabaCloud\Servicemesh;

/**
 * @method string getServiceAccount()
 * @method $this withServiceAccount($value)
 * @method string getTrustDomain()
 * @method $this withTrustDomain($value)
 * @method string getNamespace()
 * @method $this withNamespace($value)
 * @method string getServiceMeshId()
 * @method $this withServiceMeshId($value)
 */
class GetVmMeta extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
