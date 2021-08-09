<?php

namespace AliOpen\Domain;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetReserveDomainUrl
 */
class GetReserveDomainUrlRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Domain', '2018-02-08', 'GetReserveDomainUrl');
    }
}
