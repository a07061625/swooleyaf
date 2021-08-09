<?php

namespace AliOpen\Market;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteCommodity
 *
 * @method string getCommodityId()
 */
class DeleteCommodityRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Market', '2015-11-01', 'DeleteCommodity', 'yunmarket');
    }

    /**
     * @param string $commodityId
     *
     * @return $this
     */
    public function setCommodityId($commodityId)
    {
        $this->requestParameters['CommodityId'] = $commodityId;
        $this->queryParameters['CommodityId'] = $commodityId;

        return $this;
    }
}
