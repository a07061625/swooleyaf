<?php

namespace AliOpen\ROS;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of InquiryStack
 */
class InquiryStackRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/stacks/inquiry';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('ROS', '2015-09-01', 'InquiryStack');
    }
}
