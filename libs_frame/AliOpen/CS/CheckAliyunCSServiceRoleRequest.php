<?php

namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of CheckAliyunCSServiceRole
 */
class CheckAliyunCSServiceRoleRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/aliyuncsrole/status';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'CS',
            '2015-12-15',
            'CheckAliyunCSServiceRole'
        );
    }
}
