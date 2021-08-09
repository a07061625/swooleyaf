<?php

namespace AliOpen\AIRec;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of CreateInstance
 */
class CreateInstanceRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/openapi/instances';

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
            'Airec',
            '2018-10-12',
            'CreateInstance',
            'airec'
        );
    }
}
