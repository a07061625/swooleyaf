<?php

namespace AliOpen\LinkedMall;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CancelRefund
 *
 * @method string getSubLmOrderId()
 * @method string getThirdPartyUserId()
 * @method string getBizUid()
 * @method string getDisputeId()
 * @method string getBizId()
 * @method string getUseAnonymousTbAccount()
 */
class CancelRefundRequest extends RpcAcsRequest
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
        parent::__construct('linkedmall', '2018-01-16', 'CancelRefund', 'linkedmall');
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
     * @param string $disputeId
     *
     * @return $this
     */
    public function setDisputeId($disputeId)
    {
        $this->requestParameters['DisputeId'] = $disputeId;
        $this->queryParameters['DisputeId'] = $disputeId;

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
