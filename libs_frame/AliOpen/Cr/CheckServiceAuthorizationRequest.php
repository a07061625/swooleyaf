<?php
namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of CheckServiceAuthorization
 *
 */
class CheckServiceAuthorizationRequest extends RpcAcsRequest
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
        parent::__construct(
            'cr',
            '2018-12-01',
            'CheckServiceAuthorization',
            'cr'
        );
    }
}
