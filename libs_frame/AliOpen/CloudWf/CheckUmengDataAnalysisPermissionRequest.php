<?php
namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 *
 *
 * Request of CheckUmengDataAnalysisPermission
 *
 */
class CheckUmengDataAnalysisPermissionRequest extends RpcAcsRequest
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
            'cloudwf',
            '2017-03-28',
            'CheckUmengDataAnalysisPermission',
            'cloudwf'
        );
    }
}
