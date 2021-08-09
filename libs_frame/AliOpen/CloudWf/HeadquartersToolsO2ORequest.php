<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of HeadquartersToolsO2O
 *
 * @method string getBid()
 */
class HeadquartersToolsO2ORequest extends RpcAcsRequest
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
            'HeadquartersToolsO2O',
            'cloudwf'
        );
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