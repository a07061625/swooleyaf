<?php

namespace AliOpen\Kms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeRegions
 */
class DescribeRegionsRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Kms', '2016-01-20', 'DescribeRegions', 'kms');
    }
}
