<?php
namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of GetGroupApRadioConfigTemplate
 *
 */
class GetGroupApRadioConfigTemplateRequest extends RpcAcsRequest
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
            'GetGroupApRadioConfigTemplate',
            'cloudwf'
        );
    }
}
