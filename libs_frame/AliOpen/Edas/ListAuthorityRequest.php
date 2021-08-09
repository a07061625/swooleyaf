<?php

namespace AliOpen\Edas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of ListAuthority
 */
class ListAuthorityRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/pop/v5/account/authority_list';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Edas', '2017-08-01', 'ListAuthority');
    }
}
