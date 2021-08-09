<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ShopGroupDelete
 *
 * @method string getGid()
 */
class ShopGroupDeleteRequest extends RpcAcsRequest
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
            'ShopGroupDelete',
            'cloudwf'
        );
    }

    /**
     * @param string $gid
     *
     * @return $this
     */
    public function setGid($gid)
    {
        $this->requestParameters['Gid'] = $gid;
        $this->queryParameters['Gid'] = $gid;

        return $this;
    }
}
