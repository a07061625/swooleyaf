<?php

namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of PreCheckForCreateCluster
 */
class PreCheckForCreateClusterRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/api/v1/ess/precheck';

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
            'PreCheckForCreateCluster'
        );
    }
}
