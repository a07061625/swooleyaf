<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of AreaDelete
 *
 * @method string getAid()
 * @method string getSid()
 */
class AreaDeleteRequest extends RpcAcsRequest
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
            'AreaDelete',
            'cloudwf'
        );
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
