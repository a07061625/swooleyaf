<?php
namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of ListTrunkProviders
 *
 */
class ListTrunkProvidersRequest extends RpcAcsRequest
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
            'CCC',
            '2017-07-05',
            'ListTrunkProviders',
            'CCC'
        );
    }
}
