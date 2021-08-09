<?php

namespace AliOpen\ActionTrail;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetTrailStatus
 *
 * @method string getName()
 */
class TrailStatusGetRequest extends RpcAcsRequest
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
        parent::__construct('Actiontrail', '2017-12-04', 'GetTrailStatus', 'actiontrail');
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }
}
