<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetAllActiveShopByGroup
 *
 * @method array getGidss()
 * @method string getBid()
 */
class GetAllActiveShopByGroupRequest extends RpcAcsRequest
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
            'GetAllActiveShopByGroup',
            'cloudwf'
        );
    }

    /**
     * @return $this
     */
    public function setGidss(array $value)
    {
        $this->requestParameters['Gidss'] = $value;
        foreach ($value as $i => $iValue) {
            $this->queryParameters['Gids.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $bid
     *
     * @return $this
     */
    public function setBid($bid)
    {
        $this->requestParameters['Bid'] = $bid;
        $this->queryParameters['Bid'] = $bid;

        return $this;
    }
}
