<?php

namespace AliOpen\Cvc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListEvaluations
 */
class ListEvaluationsRequest extends RpcAcsRequest
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
            'aliyuncvc',
            '2019-10-30',
            'ListEvaluations',
            'aliyuncvc'
        );
    }
}
