<?php
namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 *
 *
 * Request of GetInstanceByShop
 *
 * @method string getShopId()
 */
class GetInstanceByShopRequest extends RpcAcsRequest
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
            'GetInstanceByShop',
            'cloudwf'
        );
    }

    /**
     * @param string $shopId
     *
     * @return $this
     */
    public function setShopId($shopId)
    {
        $this->requestParameters['ShopId'] = $shopId;
        $this->queryParameters['ShopId'] = $shopId;

        return $this;
    }
}
