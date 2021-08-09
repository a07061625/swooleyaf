<?php

namespace AliOpen\Nas;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteTieringJob
 *
 * @method string getVolume()
 * @method string getName()
 */
class TieringJobDeleteRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('NAS', '2017-06-26', 'DeleteTieringJob', 'nas');
    }

    /**
     * @param string $volume
     *
     * @return $this
     */
    public function setVolume($volume)
    {
        $this->requestParameters['Volume'] = $volume;
        $this->queryParameters['Volume'] = $volume;

        return $this;
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
