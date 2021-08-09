<?php

namespace AliOpen\ROS;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of PreviewStack
 */
class PreviewStackRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/stacks/preview';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('ROS', '2015-09-01', 'PreviewStack');
    }
}
