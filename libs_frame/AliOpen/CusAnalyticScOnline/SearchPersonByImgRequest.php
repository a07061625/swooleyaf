<?php
namespace AliOpen\CusAnalyticScOnline;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of SearchPersonByImg
 *
 * @method string getStoreId()
 * @method string getImgUrl()
 */
class SearchPersonByImgRequest extends RpcAcsRequest
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
            'cusanalytic_sc_online',
            '2019-05-24',
            'SearchPersonByImg'
        );
    }

    /**
     * @param string $storeId
     *
     * @return $this
     */
    public function setStoreId($storeId)
    {
        $this->requestParameters['StoreId'] = $storeId;
        $this->queryParameters['StoreId'] = $storeId;

        return $this;
    }

    /**
     * @param string $imgUrl
     *
     * @return $this
     */
    public function setImgUrl($imgUrl)
    {
        $this->requestParameters['ImgUrl'] = $imgUrl;
        $this->queryParameters['ImgUrl'] = $imgUrl;

        return $this;
    }
}
