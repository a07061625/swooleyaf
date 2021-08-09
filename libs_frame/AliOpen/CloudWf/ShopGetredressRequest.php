<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ShopGetredress
 *
 * @method string getSid()
 */
class ShopGetredressRequest extends RpcAcsRequest
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
            'ShopGetredress',
            'cloudwf'
        );
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
