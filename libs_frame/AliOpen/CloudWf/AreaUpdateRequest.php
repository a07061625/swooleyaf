<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of AreaUpdate
 *
 * @method string getName()
 * @method string getDids()
 * @method string getAid()
 * @method string getSid()
 */
class AreaUpdateRequest extends RpcAcsRequest
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
        parent::__construct(
            'cloudwf',
            '2017-03-28',
            'AreaUpdate',
            'cloudwf'
        );
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

    /**
     * @param string $dids
     *
     * @return $this
     */
    public function setDids($dids)
    {
        $this->requestParameters['Dids'] = $dids;
        $this->queryParameters['Dids'] = $dids;

        return $this;
    }

    /**
     * @param string $aid
     *
     * @return $this
     */
    public function setAid($aid)
    {
        $this->requestParameters['Aid'] = $aid;
        $this->queryParameters['Aid'] = $aid;

        return $this;
    }

    /**
     * @param string $sid
     *
     * @return $this
     */
    public function setSid($sid)
    {
        $this->requestParameters['Sid'] = $sid;
        $this->queryParameters['Sid'] = $sid;

        return $this;
    }
}
