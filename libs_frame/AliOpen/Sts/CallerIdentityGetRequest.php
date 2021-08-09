<?php
namespace AliOpen\Sts;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetCallerIdentity
 */
class CallerIdentityGetRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Sts', '2015-04-01', 'GetCallerIdentity', 'sts');
    }
}
