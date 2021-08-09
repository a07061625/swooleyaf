<?php
namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * 
 *
 * Request of CreateCluster
 *
 */
class CreateClusterRequest extends RoaAcsRequest
{

    /**
     * @var string
     */
    protected $uriPattern = '/clusters';

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
            'CS',
            '2015-12-15',
            'CreateCluster'
        );
    }
}
