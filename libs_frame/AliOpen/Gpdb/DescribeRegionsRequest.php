<?php

namespace AliOpen\Gpdb;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeRegions
 */
class DescribeRegionsRequest extends RpcAcsRequest
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
        parent::__construct('gpdb', '2016-05-03', 'DescribeRegions', 'gpdb');
    }
}
