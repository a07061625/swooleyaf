<?php

namespace AliOpen\ActionTrail;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of StartLogging
 *
 * @method string getName()
 */
class LoggingStartRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Actiontrail', '2017-12-04', 'StartLogging', 'actiontrail');
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
