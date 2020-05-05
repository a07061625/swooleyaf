<?php
namespace AliOpen\Nas;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeTieringJobs
 * @method string getVolume()
 */
class TieringJobsDescribeRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('NAS', '2017-06-26', 'DescribeTieringJobs', 'nas');
    }

    /**
     * @param string $volume
     * @return $this
     */
    public function setVolume($volume)
    {
        $this->requestParameters['Volume'] = $volume;
        $this->queryParameters['Volume'] = $volume;

        return $this;
    }
}
