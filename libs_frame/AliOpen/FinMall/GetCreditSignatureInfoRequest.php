<?php

namespace AliOpen\FinMall;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetCreditSignatureInfo
 *
 * @method string getCreditId()
 * @method string getUserId()
 */
class GetCreditSignatureInfoRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('finmall', '2018-07-23', 'GetCreditSignatureInfo', 'finmall');
    }

    /**
     * @param string $creditId
     *
     * @return $this
     */
    public function setCreditId($creditId)
    {
        $this->requestParameters['CreditId'] = $creditId;
        $this->queryParameters['CreditId'] = $creditId;

        return $this;
    }

    /**
     * @param string $userId
     *
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->requestParameters['UserId'] = $userId;
        $this->queryParameters['UserId'] = $userId;

        return $this;
    }
}
