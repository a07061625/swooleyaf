<?php

namespace AliOpen\ROS;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of ValidateTemplate
 */
class ValidateTemplateRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/validate';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('ROS', '2015-09-01', 'ValidateTemplate');
    }
}
