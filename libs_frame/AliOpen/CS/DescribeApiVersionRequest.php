<?php
namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * 
 *
 * Request of DescribeApiVersion
 *
 */
class DescribeApiVersionRequest extends RoaAcsRequest
{

    /**
     * @var string
     */
    protected $uriPattern = '/version';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'CS',
            '2015-12-15',
            'DescribeApiVersion'
        );
    }
}
