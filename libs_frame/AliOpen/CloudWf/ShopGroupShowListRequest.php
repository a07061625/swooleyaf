<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ShopGroupShowList
 *
 * @method string getPage()
 * @method string getBid()
 * @method string getPer()
 */
class ShopGroupShowListRequest extends RpcAcsRequest
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
            'ShopGroupShowList',
            'cloudwf'
        );
    }

    /**
     * @param string $page
     *
     * @return $this
     */
    public function setPage($page)
    {
        $this->requestParameters['Page'] = $page;
        $this->queryParameters['Page'] = $page;

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

    /**
     * @param string $per
     *
     * @return $this
     */
    public function setPer($per)
    {
        $this->requestParameters['Per'] = $per;
        $this->queryParameters['Per'] = $per;

        return $this;
    }
}
