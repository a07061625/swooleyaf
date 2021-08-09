<?php

namespace AliOpen\LinkedMall;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of RepayOrder
 *
 * @method string getLmOrderId()
 * @method string getThirdPartyUserId()
 * @method string getBizUid()
 * @method string getBizId()
 * @method string getUseAnonymousTbAccount()
 */
class RepayOrderRequest extends RpcAcsRequest
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
        parent::__construct('linkedmall', '2018-01-16', 'RepayOrder', 'linkedmall');
    }

    /**
     * @param string $lmOrderId
     *
     * @return $this
     */
    public function setLmOrderId($lmOrderId)
    {
        $this->requestParameters['LmOrderId'] = $lmOrderId;
        $this->queryParameters['LmOrderId'] = $lmOrderId;

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
