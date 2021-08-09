<?php

namespace AliOpen\ROS;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of DescribeResourceTypes
 *
 * @method string getSupportStatus()
 */
class DescribeResourceTypesRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/resource_types';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('ROS', '2015-09-01', 'DescribeResourceTypes');
    }

    /**
     * @param string $supportStatus
     *
     * @return $this
     */
    public function setSupportStatus($supportStatus)
    {
        $this->requestParameters['SupportStatus'] = $supportStatus;
        $this->queryParameters['SupportStatus'] = $supportStatus;

        return $this;
    }
}
