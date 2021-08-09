<?php

namespace AliOpen\ActionTrail;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeRegions
 */
class RegionsDescribeRequest extends RpcAcsRequest
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
        parent::__construct('Actiontrail', '2017-12-04', 'DescribeRegions', 'actiontrail');
    }
}
