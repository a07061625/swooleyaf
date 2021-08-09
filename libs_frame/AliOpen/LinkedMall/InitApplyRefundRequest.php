<?php

namespace AliOpen\LinkedMall;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of InitApplyRefund
 *
 * @method string getGoodsStatus()
 * @method string getSubLmOrderId()
 * @method string getThirdPartyUserId()
 * @method string getBizUid()
 * @method string getBizClaimType()
 * @method string getBizId()
 * @method string getUseAnonymousTbAccount()
 */
class InitApplyRefundRequest extends RpcAcsRequest
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
        parent::__construct('linkedmall', '2018-01-16', 'InitApplyRefund', 'linkedmall');
    }

    /**
     * @param string $goodsStatus
     *
     * @return $this
     */
    public function setGoodsStatus($goodsStatus)
    {
        $this->requestParameters['GoodsStatus'] = $goodsStatus;
        $this->queryParameters['GoodsStatus'] = $goodsStatus;

        return $this;
    }

    /**
     * @param string $subLmOrderId
     *
     * @return $this
     */
    public function setSubLmOrderId($subLmOrderId)
    {
        $this->requestParameters['SubLmOrderId'] = $subLmOrderId;
        $this->queryParameters['SubLmOrderId'] = $subLmOrderId;

        return $this;
    }

    /**
     * @param string $thirdPartyUserId
     *
     * @return $this
     */
    public function setThirdPartyUserId($thirdPartyUserId)
    {
        $this->requestParameters['ThirdPartyUserId'] = $thirdPartyUserId;
        $this->queryParameters['ThirdPartyUserId'] = $thirdPartyUserId;

        return $this;
    }

    /**
     * @param string $bizUid
     *
     * @return $this
     */
    public function setBizUid($bizUid)
    {
        $this->requestParameters['BizUid'] = $bizUid;
        $this->queryParameters['BizUid'] = $bizUid;

        return $this;
    }

    /**
     * @param string $bizClaimType
     *
     * @return $this
     */
    public function setBizClaimType($bizClaimType)
    {
        $this->requestParameters['BizClaimType'] = $bizClaimType;
        $this->queryParameters['BizClaimType'] = $bizClaimType;

        return $this;
    }

    /**
     * @param string $bizId
     *
     * @return $this
     */
    public function setBizId($bizId)
    {
        $this->requestParameters['BizId'] = $bizId;
        $this->queryParameters['BizId'] = $bizId;

        return $this;
    }

    /**
     * @param string $useAnonymousTbAccount
     *
     * @return $this
     */
    public function setUseAnonymousTbAccount($useAnonymousTbAccount)
    {
        $this->requestParameters['UseAnonymousTbAccount'] = $useAnonymousTbAccount;
        $this->queryParameters['UseAnonymousTbAccount'] = $useAnonymousTbAccount;

        return $this;
    }
}
