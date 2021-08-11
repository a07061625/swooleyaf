<?php

namespace AlibabaCloud\Cdn;

/**
 * @method string getCertId()
 * @method $this withCertId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeCertificateInfoByID extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
