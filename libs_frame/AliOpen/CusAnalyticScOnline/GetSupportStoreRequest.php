<?php
namespace AliOpen\CusAnalyticScOnline;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of GetSupportStore
 *
 */
class GetSupportStoreRequest extends RpcAcsRequest
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
            'cusanalytic_sc_online',
            '2019-05-24',
            'GetSupportStore'
        );
    }
}
